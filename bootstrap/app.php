<?php

use Illuminate\Http\JsonResponse;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        api: __DIR__ . '/../routes/api.php',
        apiPrefix: 'api/v1',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',

    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->trustProxies(at: '*');
    })
    ->withExceptions(function (Exceptions $exceptions) {
        // $exceptions->render(function ($request, Throwable $exception) {
        //     if ($exception instanceof AccessDeniedHttpException) {
        //         return new JsonResponse([
        //             'message' => 'You are not allowed for this action.',
        //             'error' => 'Access Denied',
        //         ], 403);
        //     }
        // });
    })->create();
