<?php

namespace App\Exceptions;

use Throwable;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
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
     */

     public function render($request, Throwable $exception)
     {
         if ($exception instanceof AuthenticationException) {
             return response()->json(['error' => 'You are not logged in.'], 401);
         }

         return parent::render($request, $exception);
     }


     protected function unauthenticated($request, AuthenticationException $exception)
     {
         return response()->json(['error' => 'Unauthenticated.'], 401);
     }



    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }
}
