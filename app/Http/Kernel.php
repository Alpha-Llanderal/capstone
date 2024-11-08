<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    protected $middleware = [
        // Global middleware
        \App\Http\Middleware\VerifyCsrfToken::class,
        // Other global middleware
    ];

    protected $middlewareGroups = [
        'web' => [
            \App\Http\Middleware\VerifyCsrfToken::class,
            // Other web middleware
        ],

        'api' => [
            // API middleware
        ],
    ];

    protected $routeMiddleware = [
        'auth' => \App\Http\Middleware\AuthenticateUser::class,
        'auth' => \App\Http\Middleware\EnsureUserIsAuthenticated::class,
    ];
}