<?php

namespace App\Traits;

trait RespondsWithHttpStatus
{
    protected function success($message, $data = [], $status)
    {
        return response()
        ->json([
            'success' => true,
            'message' => $message,
            'data' => $data,
        ], $status);
    }

    protected function failure($message, $status)
    {
        return response()
        ->json([
            'success' => false,
            'message' => $message,
        ], $status);
    }

    protected function loginSuccess($message, $data = [], $status, $access_token)
    {
        return response()
        ->json([
            'success' => true,
            'message' => $message,
            'data' => $data,
            'access_token' => $access_token
        ], $status);
    }
}
