<?php

namespace App\Traits;

use Core\Response;

trait ApiResponse
{
    public function sendResponse($data, $message = 'ok', $code = Response::HTTP_OK, $extraData = []): false|string
    {
        return Response::json($this->makeResponse($message, $data, $extraData), $code);
    }

    private function makeResponse($message = 'ok', $data = [], array $extraData = []): array
    {
        $response = ['data' => $data, 'message' => $message,];

        if (!empty($extraData)) {
            $response = array_merge($response, $extraData);
        }

        return $response;
    }

    public function sendError($code, $message = '', $data = []): false|string
    {
        return Response::json($this->makeError($message, $data), $code);
    }

    private function makeError($message = '', $data = []): array
    {
        return ['data' => $data, 'message' => $message,];
    }
}