<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\App;
use Illuminate\Validation\ValidationException;
use RuntimeException;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Репортим ошибки в Sentry
     *
     * @param Throwable $exception
     * @return void
     *
     * @throws Throwable
     */
    public function report(Throwable $exception): void
    {
        if (config('sentry.dsn')) {
            if (app()->bound('sentry') && $this->shouldReport($exception)) {
                app('sentry')->captureException($exception);
            }
        }

        parent::report($exception);
    }

    /**
     * Определяем, как будут выглядеть наши ошибки
     *
     * @param $request
     * @param Throwable $exception
     * @return \Illuminate\Http\Response|JsonResponse|Response|null
     */
    public function render($request, Throwable $exception): \Illuminate\Http\Response|JsonResponse|Response|null
    {
        $exception = $this->prepareException($exception);

        return match (true) {
            $exception instanceof AppException => $this->renderCustomAppException($request, $exception),
            $exception instanceof AuthorizationException, $exception instanceof AuthenticationException => $this->renderCustomAuthException($request, $exception),
            $exception instanceof ValidationException => $this->renderCustomValidationException($request, $exception),
            $exception instanceof HttpException => $this->renderCustomHttpException($request, $exception),
            default => $this->renderCustomException($request, $exception),
        };

    }

    /**
     * Выводим ошибки приложения, рендер задается внутри Exception
     *
     * @param $request
     * @param AppException $exception
     * @return JsonResponse
     */
    private function renderCustomAppException($request, AppException $exception): JsonResponse
    {
        return $exception->render($request);
    }

    /**
     * Выводим ошибки авторизации Laravel
     *
     * @param $request
     * @param Exception $exception
     * @return JsonResponse
     */
    private function renderCustomAuthException($request, Exception $exception): JsonResponse
    {
        $response = [
            'status' => 401,
            'message' => $exception->getMessage(),
        ];

        $response = $this->addRequestDataToResponse($response, $request);
        $response = $this->addDebugDataToResponse($response, $exception);

        return response()->json($response, 401);
    }

    /**
     * Хелпер для добавления данных о Request
     *
     * @param array $response
     * @param $request
     * @return array
     */
    private function addRequestDataToResponse(array $response = [], $request = null): array
    {
        if (App::environment() !== 'production') {
            $response = array_merge($response, [
                'request' => [
                    'json' => $request->json()->all(),
                    'method' => $request->getMethod(),
                ],
            ]);
        }

        return $response;
    }

    /**
     * Хелпер для добавления данных debug
     *
     * @param array $response
     * @param $exception
     * @return array|\array[][]|int[]|string[]
     */
    private function addDebugDataToResponse(array $response = [], $exception = null): array
    {
        if (App::environment() !== 'production') {
            $response = array_merge($response, [
                'debug' => [
                    'file' => $exception->getFile(),
                    'line' => $exception->getLine(),
                    'trace' => $exception->getTrace(),
                ]
            ]);
        }

        return $response;
    }

    /**
     * Выводим ошибки валидации Laravel
     *
     * @param $request
     * @param ValidationException $exception
     * @return JsonResponse
     */
    private function renderCustomValidationException($request, ValidationException $exception): JsonResponse
    {

        $response = [
            'status' => $exception->status,
            'message' => $exception->getMessage(),
            'errors' => $exception->errors(),
        ];

        $response = $this->addRequestDataToResponse($response, $request);
        $response = $this->addDebugDataToResponse($response, $exception);

        return response()->json($response, $exception->status);
    }

    /**
     * Выводим ошибки HTTP Symphony
     *
     * @param $request
     * @param HttpException $exception
     * @return JsonResponse
     */
    private function renderCustomHttpException($request, HttpException $exception): JsonResponse
    {

        $response = [
            'status' => $exception->getStatusCode(),
            'message' => $exception->getMessage(),
        ];

        $response = $this->addRequestDataToResponse($response, $request);
        $response = $this->addDebugDataToResponse($response, $exception);

        return response()->json($response, $exception->getStatusCode());
    }

    /**
     * Выводим все остальные ошибки
     *
     * @param $request
     * @param $exception
     * @return JsonResponse
     */
    private function renderCustomException($request, $exception): JsonResponse
    {

        $response = [
            'status' => 500,
            'message' => $exception->getMessage(),
        ];

        $response = $this->addRequestDataToResponse($response, $request);
        $response = $this->addDebugDataToResponse($response, $exception);

        return response()->json($response, 500);
    }

}
