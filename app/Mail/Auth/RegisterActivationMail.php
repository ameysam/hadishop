<?php

namespace App\Mail\Auth;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RegisterActivationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $receiver;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $receiver)
    {
        $this->receiver = $receiver;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $data = [
            'url' => route('register.activation', $this->receiver->activation_token),
        ];

        return $this
                ->subject('تکمیل ثبت نام ' . config('app.name'))
                ->markdown('auth.email.register_confirmation', $data);
    }
}
