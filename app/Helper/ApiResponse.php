<?php

namespace App\Helper;

class ApiResponse
{
    static function sendResponse($code = 200, $message = null, $data = [])
    {
        $response = [
            'status' => $code,
            'message' => $message,
            'data' => $data
        ];

        return response()->json($response, $code);
    }
}
