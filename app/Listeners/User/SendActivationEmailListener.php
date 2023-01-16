<?php

namespace App\Listeners\User;

use App\Constants\Types\User\UserActivationStatusType;
use App\Events\User\SignUpEvent;
use App\Mail\Auth\RegisterActivationMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class SendActivationEmailListener implements ShouldQueue
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  UserSignUpEvent  $event
     * @return void
     */
    public function handle(SignUpEvent $event)
    {
        $receiver = $event->receiver;

        if($receiver->isActivationEmail())
        {
            $receiver->activation_status = UserActivationStatusType::USER_ACTIVATION_STATUS_UNACTIVE;
            $receiver->activation_token = Str::randomCode(60);
            $receiver->save();

            Mail::to($receiver)->send(new RegisterActivationMail($receiver));
        }
    }
}
