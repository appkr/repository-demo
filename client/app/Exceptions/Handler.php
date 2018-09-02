<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class Handler extends ExceptionHandler
{
    protected $dontReport = [
        //
    ];

    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    public function render($request, Exception $exception)
    {
        if ($request->wantsJson()) {
            return new JsonResponse([
                'code' => $exception->getCode(),
                'message' => $exception->getMessage(),
            ], $exception->getCode() ?: Response::HTTP_INTERNAL_SERVER_ERROR);
        }
        return parent::render($request, $exception);
    }
}
