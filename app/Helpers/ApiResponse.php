<?php

namespace App\Helpers;

class ApiResponse
{
    public static function success($data = null, $code = 200)
    {
        return response()->json([
            'meta' => [
                'version' => '1.0',
                'status' => 'ok',
                'code' => $code,
            ],
            'data' => $data,
            'error' => null,
        ], $code);
    }

    public static function error($message, $code = 400, $errors = null)
    {
        return response()->json([
            'meta' => [
                'version' => '1.0',
                'status' => 'error',
                'code' => $code,
            ],
            'data' => null,
            'error' => [
                'message' => $message,
                'details' => $errors,
            ],
        ], $code);
    }
}