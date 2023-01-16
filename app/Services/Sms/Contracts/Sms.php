<?php

namespace App\Services\Sms\Contracts;

use App\Services\CURL\Curl;
use App\Models\User;

/**
 * Class Sms
 * @package App\Services\Sms\Contracts
 * @property User $user
 * @property Curl $curl
 * @property string $url
 * @property string $template
 * @property string $token
 * @property array $body
 * @property string $message
 * @author M.Alipuor <meysam.alipuor@gmail.com>
 */
abstract class Sms implements SmsContract
{
    /**
     * @var User
     */
    protected $user;


    /**
     * @var Curl
     */
    protected $curl;


    /**
     * @var string
     */
    protected $url;


    /**
     * @var string
     */
    protected $template;


    /**
     * @var string
     */
    protected $token;


    /**
     * @var string
     */
    protected $token2;


    /**
     * @var string
     */
    protected $token3;


    /**
     * @var array
     */
    protected $body;


    /**
     * @var string
     */
    protected $message;


    /**
     * @var string
     */
    protected $mobile_field_name;


    /**
     * Set user as receiver.
     *
     * @param User $user
     * @return $this
     * @author M.Alipuor <meysam.alipuor@gmail.com>
     */
    public function setUser(User $user)
    {
        $this->user = $user;
        return $this;
    }

    /**
     * Set mobile field name.
     *
     * @param string $value
     * @return $this
     * @author M.Alipuor <meysam.alipuor@gmail.com>
     */
    public function setMobileFieldName(string $value)
    {
        $this->mobile_field_name = $value;
        return $this;
    }


    /**
     * Set api url.
     *
     * @param string $url
     * @author M.Alipuor <meysam.alipuor@gmail.com>
     */
    protected function setUrl(string $url)
    {
        $this->url = $url;
        $this->curl = new Curl($url);
    }


    /**
     * Set template for lookup.
     *
     * @param string $template
     * @return $this
     * @author M.Alipuor <meysam.alipuor@gmail.com>
     */
    public function setTemplate(string $template)
    {
        $this->template = $template;
        return $this;
    }


    /**
     * Set token for lookup.
     *
     * @param string $token
     * @return $this
     * @author M.Alipuor <meysam.alipuor@gmail.com>
     */
    public function setToken(string $token)
    {
        $this->token = $token;
        return $this;
    }


    /**
     * Set token2 for lookup.
     *
     * @param string $token
     * @return $this
     * @author M.Alipuor <meysam.alipuor@gmail.com>
     */
    public function setToken2(string $token)
    {
        $this->token2 = $token;
        return $this;
    }

    /**
     * Set token3 for lookup.
     *
     * @param string $token
     * @return $this
     * @author M.Alipuor <meysam.alipuor@gmail.com>
     */
    public function setToken3(string $token)
    {
        $this->token3 = $token;
        return $this;
    }


    /**
     * Set message for receiver.
     *
     * @param string $message
     * @return $this
     * @author M.Alipuor <meysam.alipuor@gmail.com>
     */
    public function setMessage(string $message)
    {
        $this->message = $message;
        return $this;
    }


    /**
     * Set body and prepare curl before call api.
     *
     * @param array $body
     * @return $this
     * @author M.Alipuor <meysam.alipuor@gmail.com>
     */
    protected function setBody(array $body)
    {
        $this->body = $body;

        $this->curl->init('post', $this->body, true);

        return $this;
    }


    /**
     * Fire api.
     *
     * @return mixed
     * @author M.Alipuor <meysam.alipuor@gmail.com>
     */
    protected function fire()
    {
        if(env('SEND_SMS') != '1')
        {
            return false;
        }

        return $this->curl->exec();
    }
}
