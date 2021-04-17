<?php

namespace App\Exceptions;

use Exception;
use Throwable;
use App\helper\Responser;
use \Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;

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
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    /**
     * Convert an authentication exception into a response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Illuminate\Auth\AuthenticationException  $exception
     * @return \Symfony\Component\HttpFoundation\Response
     */
    protected function unauthenticated($request, AuthenticationException $exception)
    {
        //$exception->getMessage()
        return $request->expectsJson()
                    ? response()->json(["status"=>false,'message' => "Unauthorized access","data"=>[]], 401)
                    : redirect()->guest($exception->redirectTo() ?? route('login'));
    }
    // public function render($request, Throwable $exception)
    // {
    //     if ($request->expectsJson()) {   //add Accept: application/json in request
    //         return $this->handleApiException($request, $exception);
    //     } else {
    //         $retval = parent::render($request, $exception);
    //     }

    //     return $retval;
    // }

    private function handleApiException($request, Exception $exception)
    {
        $exception = $this->prepareException($exception);

        if ($exception instanceof HttpResponseException) {
            $exception = $exception->getResponse();
        }

        if ($exception instanceof MethodNotAllowedHttpException) {
            $exception = $exception->getResponse();
        }

        return $this->customApiResponse($exception);
    }

    private function customApiResponse($exception)
    {
        if (method_exists($exception, 'getStatusCode')) {
            $statusCode = $exception->getStatusCode();
        } else {
            $statusCode = 500;
        }

        $data = [];

        switch ($statusCode) {
        case 401:
            $data['message'] = 'Unauthorized';
            break;
        case 403:
            $data['message'] = 'Forbidden';
            break;
        case 404:
            $data['message'] = 'Method Not Found';
            break;
        case 405:
            $data['message'] = 'Method Not Allowed';
            break;
        case 422:
            $data['message'] = $exception->original['message'];
            $data['errors'] = $exception->original['errors'];
            break;
        default:
            $data['message'] = ($statusCode == 500) ? 'Whoops, looks like something went wrong' : $exception->getMessage();
            break;
    }

        if (config('app.debug')) {
            $data['trace'] = $exception->getTrace();
            $data['code'] = $exception->getCode();
        }

        $data['status_code'] = $statusCode;
        $status=false;
        return response()->json(compact('status', 'data', ), $statusCode);
    }
}
