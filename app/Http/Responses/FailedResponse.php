<?php

namespace App\Http\Responses;

use Illuminate\Contracts\Support\Responsable;

class FailedResponse implements Responsable
{

    private $item_name;

    private $message;

    public function __construct(string $item_name = 'status', string $message = null, array $data = [])
    {
        $this->item_name = $item_name;

        $this->message = $message ?? 'خطا در انجام عملیات.';

        $this->data = $data;
    }

    public function toResponse($request)
    {
        $response = [
            $this->item_name => false,
            'message' => $this->message,
        ];

        if(count($this->data))
        {
            foreach($this->data as $key => $value)
            {
                $response[$key] = $value;
            }
        }

        return $response;
    }
}
