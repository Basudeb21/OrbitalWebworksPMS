<?php

namespace App\Helpers;

class ApiResponse
{
    public static function success($data = null, $message = 'Success', $status = HttpStatus::OK)
    {
        return response()->json([
            'success' => true,
            'message' => $message,
            'data' => $data,
        ], $status);
    }

    public static function error($message = 'Something went wrong', $errors = [], $status = HttpStatus::INTERNAL_SERVER_ERROR)
    {
        return response()->json([
            'success' => false,
            'message' => $message,
            'data' => null,
            'errors' => $errors
        ], $status);
    }
}
