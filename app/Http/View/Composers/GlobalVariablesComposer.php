<?php

namespace App\Http\View\Composers;

use App\Models\Message;
use App\Services\Message\MessageFetchService;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class GlobalVariablesComposer
{
    private $messageFetchService;

    public function __construct(MessageFetchService $messageFetchService)
    {
        $this->messageFetchService = $messageFetchService;
    }

    /**
     * Bind data to the view.
     *
     * @param View  $view
     * @return void
     * @author M.Alipuor <meysam.alipuor@gmail.com>
     */
    public function compose(View $view)
    {
        $user = Auth::user();

        if($user)
        {
            $view->with('_current_user', $user);

            $_unseen_messages_count = $this->messageFetchService
            ->whereReceivers([$user->id])
            ->whereUnseen()
            ->prepareQuery()
            ->count();

            $view->with('_unseen_messages_count', $_unseen_messages_count);
        }
    }
}
