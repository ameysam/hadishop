<?php


namespace App\Services\Sms\Contracts;


interface SmsContract
{
    public function lookup();

    public function send();
}
