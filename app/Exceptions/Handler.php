<?php

namespace App\Exceptions;

use Exception;
use App\Http\ApiResponse;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

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
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Exception  $exception
     * @return void
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {
        if (env('APP_DEBUG') == false) {
            $apiResponse = new ApiResponse;

            if ($exception instanceof \Symfony\Component\Debug\Exception\FatalErrorException) {
                return $apiResponse->httpResponseInternalError();
            }

            if ($exception instanceof \Symfony\Component\HttpKernel\Exception\NotFoundHttpException) {
                return $apiResponse->httpResponseNotFound();
            }

            if ($exception instanceof \Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException) {
                return $apiResponse->httpResponseNotAllowed();
            }

            if ($exception instanceof \League\OAuth2\Server\Exception\OAuthException) {
                return $apiResponse->httpResponseBadRequest($exception->getMessage());
            }

            if ($exception instanceof \App\Exceptions\ForbiddenException) {
                return $apiResponse->httpResponseForbidden($exception->getMessage());
            }

            if ($exception instanceof \App\Exceptions\UserNotAuthorizedException) {
                return $apiResponse->httpResponseUnauthorized($exception->getMessage());
            }

            if ($exception instanceof \App\Exceptions\InvalidDataException) {
                return $apiResponse->httpResponseBadRequest($exception->getMessage());
            }

            if ($exception instanceof \App\Exceptions\DataNotFoundException) {
                return $apiResponse->httpResponseNotFound($exception->getMessage());
            }

            if ($exception instanceof \App\Exceptions\DataDuplicationException) {
                return $apiResponse->httpResponseBadRequest($exception->getMessage());
            }

            if ($exception instanceof \ErrorException) {
                return $apiResponse->httpResponseInternalError();
            }
        }

        return parent::render($request, $exception);
    }
}
