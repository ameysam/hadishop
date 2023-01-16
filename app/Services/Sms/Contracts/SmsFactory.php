<?php

namespace App\Services\Sms\Contracts;

use App\Services\Sms\Src\Kavenegar\Kavenegar;

/**
 * Class SmsFactory
 * @package App\Services\Sms\Contracts
 * @property string $provider
 * @author M.Alipuor <meysam.alipuor@gmail.com>
 */
class SmsFactory
{

    /**
     * @var string
     */
    private $provider;


    /**
     * SmsFactory constructor.
     * @param string $provider
     * @author M.Alipuor <meysam.alipuor@gmail.com>
     */
    public function __construct(string $provider)
    {
        $this->provider = $provider;
    }


    /**
     * Make provider object.
     *
     * @return Kavenegar
     * @author M.Alipuor <meysam.alipuor@gmail.com>
     */
    public function provider()
    {
        switch ($this->provider)
        {
            case 'kavenegar':
                return new Kavenegar(config('services.kavenegar.api_key'));
        }
    }
}
