<?php

use App\Http\Middleware\JsonResponseMiddleware;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Support\Facades\Route;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
        then: function () {
            Route::middleware('api')
                ->prefix('api/v1')
                ->as('api.v1.')
                ->group(base_path('routes/api/v1.php'));
        },
    )
    ->withMiddleware(function (Middleware $middleware): void {
        //

        $middleware->group('api', [
            JsonResponseMiddleware::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        $exceptions->render(function (Throwable $e) {

            if ($e instanceof AuthenticationException) {
                return error_response('unauthenticated', 401);
            }

            if ($e instanceof Exception) {
                return error_response($e->getMessage(), $e->status ?? 400);
            }

            if ($e instanceof ValidationException) {
                return error_response($e->validator->errors()->first(), $e->status ?? 400);
            }

            if ($e instanceof ModelNotFoundException) {
                return error_response('model_not_found', 400);
            }
        });
    })->create();
