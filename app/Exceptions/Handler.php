<?php

namespace App\Exceptions;

use App\HelperClasses\MessagesFlash;
use App\HelperClasses\TResponse;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Support\Facades\Route;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    use TResponse;
    /**
     * A list of exception types with their corresponding custom log levels.
     *
     * @var array<class-string<\Throwable>, \Psr\Log\LogLevel::*>
     */
    protected $levels = [
        //
    ];

    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<\Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     */

    const Page_404 = "pages.errors.404" ;
    const Page_500 = "pages.errors.500" ;

    public function register()
    {
        $this->renderable(function (Throwable $e) {
            if (!urlIsApi() && !request()->ajax()){
                dd($e);
            }
            if ($e instanceof MainException){
                return $this->responseError($e->getMessage(),"MainException");
            }
            if ($e instanceof ValidationException) {
                return $this->responseError($e->errors(),"ValidationException");
            }
            if ($e instanceof AuthorizationException){
                return $this->responseError($e->getMessage(),"AuthorizationException",true,null,null,500);
            }
            if ($e instanceof AuthenticationException) {
                return $this->responseError($e->getMessage(),"AuthenticationException",false,null,"login");
            }
            if ($e instanceof NotFoundHttpException || $e instanceof ModelNotFoundException){
                return $this->responseError($e->getMessage(),"NotFoundHttpException",false,self::Page_404,null,404);
            }
            if ($e instanceof MethodNotAllowedHttpException){
                return $this->responseError($e->getMessage(),"MethodNotAllowedHttpException",false,self::Page_404,null,404);
            }
            if ($e instanceof AccessDeniedHttpException){
                return $this->responseError($e->getMessage(),"AccessDeniedHttpException",false,self::Page_500,null,500);
            }
        });
    }
}
