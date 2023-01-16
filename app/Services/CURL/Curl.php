<?php

namespace App\Services\CURL;

/**
 * Class CURL
 * @package App\Services\CURL
 * @property string $url
 * @property Curl $curl
 * @author M.Alipuor <meysam.alipuor@gmail.com>
 */
class Curl
{
    /**
     * @var string
     */
    private $url;

    /**
     * curl object.
     *
     * @var Curl
     */
    private $curl;

    /**
     *
     * CURL constructor.
     * @param $url string.
     * @author M.Alipuor <meysam.alipuor@gmail.com>
     */
    public function __construct(string $url)
    {
        $this->url = $url;
    }

    /**
     * Initialize curl.
     *
     * @param string $method
     * @param array $body
     * @param bool $build_query
     * @author M.Alipuor <meysam.alipuor@gmail.com>
     */
    public function init($method = 'post', $body = [], $build_query = false)
    {
        $curl = curl_init($this->url);
        if ($build_query)
        {
            $payload = http_build_query($body);
        }
        else
        {
            $payload = json_encode($body);
        }
        if ($method == 'post')
        {
            curl_setopt($curl, CURLOPT_POST, true);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $payload);
        }
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $this->curl = $curl;
    }

    /**
     * Set headers to curl request.
     *
     * @param array $headers
     * @author M.Alipuor <meysam.alipuor@gmail.com>
     */
    public function setHeader($headers)
    {
        curl_setopt($this->curl, CURLOPT_HTTPHEADER, $headers);
    }

    /**
     * Close curl.
     * @author M.Alipuor <meysam.alipuor@gmail.com>
     */
    public function close()
    {
        curl_close($this->curl);
    }

    /**
     * Execute curl.
     *
     * @return mixed
     * @author M.Alipuor <meysam.alipuor@gmail.com>
     */
    public function exec()
    {
        return curl_exec($this->curl);
    }

    /**
     * Return current curl.
     *
     * @return object
     * @author M.Alipuor <meysam.alipuor@gmail.com>
     */
    public function get()
    {
        return $this->curl;
    }
}
