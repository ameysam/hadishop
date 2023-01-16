<?php

namespace App\Http\Responses;

use Illuminate\Contracts\Support\Responsable;

class SuccessResponse implements Responsable
{

    private $item_name;

    private $message;

    public function __construct(string $item_name = 'status', string $message = null, array $data = [])
    {
        $this->item_name = $item_name;

        $this->message = $message ?? 'عملیات با موفقیت انجام شد.';

        $this->data = $data;
    }

    public function toResponse($request)
    {
        $response = [
            $this->item_name => true,
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
