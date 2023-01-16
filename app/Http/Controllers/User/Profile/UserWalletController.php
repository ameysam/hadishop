<?php

namespace App\Http\Controllers\User\Profile;

use App\Constants\Types\Payment\PaymentStatusType;
use App\Constants\Types\WalletHistory\WalletHistoryCauseType;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\ChargeWalletRequest;
use App\Http\Responses\FailedResponse;
use App\Http\Responses\SuccessResponse;
use App\Models\CenterSectionService;
use App\Models\WalletHistory;
use App\Services\Payment\Contracts\Payment;
use App\Services\PaymentHistory\PaymentHistoryService;
use App\Services\User\Admin\WalletService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class UserWalletController extends Controller
{
    private $charge_reson;


    public function __construct()
    {
        $this->charge_reson = 'Manual Charge Wallet';
    }


    public function index()
    {
        $user = Auth::user();

        $records = WalletHistory::where('user_id', $user->id)->orderBy('id', 'DESC')->orderBy('created_at', 'DESC')->paginate(10);

        $data = [
            'user' => $user,
            'records' => $records,
            'wallet_charge_url' => route('admin.profile.wallet.charge'),
        ];

        $this->breadcrumb();

        return view('users.profile.wallet.index', $data);
    }


    public function charge(ChargeWalletRequest $request, Payment $payment, PaymentHistoryService $paymentHistoryService)
    {
        $user = Auth::user();

        $amount = $request['amount'];
        $description = $request['description'] ?? $this->charge_reson;

        # Send payment request to gateway
        $result = $payment
            ->setAmount($amount)
            ->setDescription($description)
            ->pay();

        if($result->getOk() == true && $result->getStatus() == 100)
        {
            $authority = $result->getAuthority();
            $gateway = $result->getGateway();
            $cause = WalletHistoryCauseType::WALLET_HISTORY_MANUAL_CHARGE;

            # Create Payment record
            $payment_record = $paymentHistoryService->createRecord($user, $amount, $authority, $gateway, $cause, $description);

            $response_data = [
                'redirect_url' => $result->getUrl(),
            ];

            return new SuccessResponse('status', null, $response_data);
        }

        $response_data = [
            'message' => $result->getMessage(),
        ];

        return new FailedResponse('status', null, $response_data);
    }


    public function verify(Request $request, Payment $payment, PaymentHistoryService $paymentHistoryService, WalletService $walletService)
    {
        if(empty($request['Authority']) || empty($request['Status']))
        {
            abort(404);
        }

        $user = Auth::user();

        $_authority = Str::ltrimZero($request['Authority']);
        $_status = $request['Status'];

        $payment_record = $paymentHistoryService->findPaymentWithReqID($user, $_authority);

        if(! $payment_record)
        {
            abort(404);
        }

        $result = $payment
            ->setAmount($payment_record->amount)
            ->setAuthority($request['Authority'])
            ->verify($_status);

        $status = $result->getOk() ? PaymentStatusType::PAYMENT_STATUS_ACCEPTED : PaymentStatusType::PAYMENT_STATUS_REJECTED;


        # If verifying is correct
        if($result->getOk())
        {
            return DB::transaction(function () use ($paymentHistoryService, $payment_record, $result, $user, $walletService) {
                $status = PaymentStatusType::PAYMENT_STATUS_ACCEPTED;

                # Update the user wallet
                $walletService->updateWallet($user, $payment_record->amount, WalletHistoryCauseType::WALLET_HISTORY_MANUAL_CHARGE);

                # Update payement record
                $paymentHistoryService->updateRecord($payment_record, $status, $result->getStatus(), $result->getRefID());

                # Create wallet history log
                $charge_reson = $payment_record->description != $this->charge_reson
                                ? $payment_record->description
                                : '';

                $walletService->log($user, $payment_record->amount, $payment_record->cause, $payment_record, $user, null, null, $charge_reson);

                if($payment_record->action_page_url)
                {
                    return redirect()->to($payment_record->action_page_url)->with('message', __('layout.payment.successful'))->with('status', '1');
                }
                return redirect()->route('admin.profile.wallet.index')->with('message', __('layout.payment.successful'))->with('status', '1');
            });
        }
        else
        {
            $status = PaymentStatusType::PAYMENT_STATUS_REJECTED;

            $paymentHistoryService->updateRecord($payment_record, $status, $result->getStatus());

            if($payment_record->action_page_url)
            {
                return redirect()->to($payment_record->action_page_url)->with('message', __('layout.payment.failed'))->with('status', '0');
            }
            return redirect()->route('admin.profile.wallet.index')->with('message', __('layout.payment.failed'))->with('status', '0');
        }
    }


    public function prePayment(Request $request)
    {
        $user = Auth::user();

        $amount = $request['amount'];

        if($center_service = $request['center_service_id'])
        {
            $center_service = CenterSectionService::findOrFail($center_service);

            $amount = $center_service->full_price;
        }

        $response = [
            'ok' => true,
            'wallet_value' => number_format($user->wallet),
            'amount' => number_format($amount),
            'payable' => 0,
        ];

        if($user->hasInventory($amount))
        {
            $response['status'] = 1; # Can reduce from wallet
        }
        else
        {
            $response['status'] = 2; # Cannot reduce from wallet
            $response['payable'] = number_format($amount - $user->wallet);
        }

        return $response;
    }

    /**
    * Set breadcrumb.
    */
   private function breadcrumb()
   {
       $breadcrumb = [
           [
               'title' => 'پروفایل',
               'link' => '#',
           ],
           [
               'title' => 'کیف پول',
               'link' => route('admin.profile.wallet.index'),
           ],
       ];

       $this->setBreadcrumb($breadcrumb);
   }
}
