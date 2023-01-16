<?php

namespace App\Constants;


/**
 * Class ErrorResponse
 * This class is created for make http response with code, message, status, data and etc.
 *
 * @package App\Constants
 * @author M.Alipuor <meysam.alipuor@gmail.com>
 */
class ErrorResponse
{

    /**
     * Make an response and return it.
     *
     * @param string $type
     * @param null $message
     * @param null $data
     * @param null $status
     * @param null $extra_data
     * @return array
     * @author M.Alipuor <meysam.alipuor@gmail.com>
     */
    public static function get(string $type, $message = null, $data = null, $status = null, $extra_data = null): array
    {
        $response = self::$status[$type];
        if($message)
        {
            $response['message'] = $message;
        }
        if($data)
        {
            $response['data'] = $data;
        }
        if($status === true || $status === false)
        {
            $response['status'] = $status;
        }
        if(is_array($extra_data))
        {
            $response['extra_data'] = $extra_data;
        }
        return $response;
    }

    /**
     * @var array
     * @author M.Alipuor <meysam.alipuor@gmail.com>
     */
    private static $status = [
        HttpCode::_200 => [
            'status' => true,
            'code' => HttpCode::_200,
            'message' => null,
            'data' => []
        ],
        HttpCode::_204 => [
            'status' => false,
            'code' => HttpCode::_204,
            'message' => 'No Content.',
            'data' => []
        ],
        HttpCode::_400 => [
            'status' => false,
            'code' => HttpCode::_400,
            'message' => 'Bad Request.',
            'data' => []
        ],
        HttpCode::_401 => [
            'status' => false,
            'code' => HttpCode::_401,
            'message' => 'Unauthenticated.',
            'data' => []
        ],
        HttpCode::_404 => [
            'status' => false,
            'code' => HttpCode::_404,
            'message' => 'Not Found.',
            'data' => []
        ],
        HttpCode::_405 => [
            'status' => false,
            'code' => HttpCode::_405,
            'message' => 'Method Not Allowd.',
            'data' => []
        ],
        HttpCode::_406 => [
            'status' => false,
            'code' => HttpCode::_406,
            'message' => 'Not Acceptable.',
            'data' => []
        ],
        HttpCode::_409 => [
            'status' => false,
            'code' => HttpCode::_409,
            'message' => 'More than inventory.',
            'data' => []
        ],
        HttpCode::_422 => [
            'status' => false,
            'code' => HttpCode::_422,
            'message' => 'Some Errors.',
            'data' => []
        ],
        HttpCode::_500 => [
            'status' => false,
            'code' => HttpCode::_500,
            'message' => 'Internal Server Error.',
            'data' => []
        ],
    ];
}
