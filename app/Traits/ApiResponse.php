<?php

namespace App\Traits;

use Framework\Responses\Response as ResponseAlias;
use Framework\Support\Facades\Response;

trait ApiResponse {
    public function sendResponse($data, $message = 'ok', $code = ResponseAlias::HTTP_OK, $extraData = []) {
        return Response::json($this->makeResponse($message, $data, $extraData), $code);
    }

    private function makeResponse($message = 'ok', $data = [], array $extraData = []): array {
        $response = ['data' => $data, 'message' => $message,];

        if (!empty($extraData)) {
            $response = array_merge($response, $extraData);
        }

        return $response;
    }

    public function sendError($code, $message = '', $data = []) {
        return Response::json($this->makeError($message, $data), $code);
    }

    private function makeError($message = '', $data = []) {
        return ['data' => $data, 'message' => $message,];
    }
}