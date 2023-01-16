<?php

namespace App\Services\Sms\Src\Kavenegar;

use App\Services\Sms\Contracts\Sms;

/**
 * Class Kavenegar
 * @package App\Services\Sms\Src\Kavenegar
 * @property string $apiKey
 * @author M.Alipuor <meysam.alipuor@gmail.com>
 */
class Kavenegar extends Sms
{

    /**
     * @var string
     */
    private $apiKey;


    /**
     * Kavenegar constructor.
     * @param string $apiKey
     * @author M.Alipuor <meysam.alipuor@gmail.com>
     */
    public function __construct(string $apiKey)
    {
        $this->apiKey = $apiKey;
    }


    /**
     * @return mixed
     * @author M.Alipuor <meysam.alipuor@gmail.com>
     */
    public function lookup()
    {
        $this->setUrl("https://api.kavenegar.com/v1/{$this->apiKey}/verify/lookup.json");

        $receptor = $this->user[$this->mobile_field_name ?? 'mobile_no'];
        $body = [
            // 'receptor' => $this->user->mobile_no,
            'receptor' => $receptor,
            'token' => $this->token,
            'template' => $this->template,
        ];

        if($this->token2)
        {
            $body['token2'] = $this->token2;
        }

        if($this->token3)
        {
            $body['token3'] = $this->token3;
        }

        $this->setBody($body);

//        $curl->setHeader([
//            'Content-Type:application/json',
//            'Authorization:Bearer ' . config('payping.token'),
//        ]);

        return $this->fire();
    }


    /**
     * @return mixed
     * @author M.Alipuor <meysam.alipuor@gmail.com>
     */
    public function send()
    {
        $this->setUrl("https://api.kavenegar.com/v1/{$this->apiKey}/sms/send.json");

        $receptor = $this->user[$this->mobile_field_name ?? 'mobile_no'];

        $body = [
            'receptor' => $this->user->mobile_no,
            'receptor' => $receptor,
            'message' => $this->message,
        ];

        $this->setBody($body);

        return $this->fire();
    }


    /**
     * @return mixed
     * @author M.Alipuor <meysam.alipuor@gmail.com>
     */
    public function sendArray(array $receptors, array $messages)
    {
        $this->setUrl("https://api.kavenegar.com/v1/{$this->apiKey}/sms/sendarray.json");

        $line = config('services.kavenegar.line');

        // dd(json_encode(array_pad([$line], count($messages), $line)));

        $body = [
            'receptor' => json_encode($receptors),
            'message' => json_encode($messages),
            'sender' => json_encode(array_pad([$line], count($messages), $line)),
        ];

        // dd($body);

        $this->setBody($body);

        return $this->fire();
    }

}
