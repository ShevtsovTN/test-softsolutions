<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class AppException extends Exception
{
    private array $headers = [];
    private array $params = [];

    /**
     * @return array
     */
    public function getParams(): array
    {
        return $this->params;
    }

    /**
     * @param array $params
     */
    public function setParams(array $params): void
    {
        $this->params = $params;
    }

    /**
     * @return array
     */
    public function getHeaders(): array
    {
        return $this->headers;
    }

    /**
     * @param array $headers
     */
    public function setHeaders(array $headers): void
    {
        $this->headers = $headers;
    }

    /**
     * CompanyReport or log an exception.
     *
     * @return void
     */
    public function report(): void
    {
    }

    /**
     * Render the exception into an HTTP response.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function render(Request $request): JsonResponse
    {

        $response = [
            'status' => $this->getCode(),
            'message' => $this->getMessage(),
            'records' => $this->getParams(),
            'request' => [
                'json' => $request->all(),
                'method' => $request->getMethod(),
            ],
        ];

        if (App::environment() !== 'production') {
            $response = array_merge($response, [
                'debug' => [
                    'file' => $this->getFile(),
                    'line' => $this->getLine(),
                    'trace' => $this->getTrace(),
                ]
            ]);
        }

        return response()->json($response, $this->getCode(), $this->getHeaders(), JSON_UNESCAPED_UNICODE);
    }
}
