<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        //global middleware
        // $middleware->append(\App\Http\Middleware\PromotionMW::class);

        // Render (and other hosts) run behind a reverse proxy; trust forwarded headers
        // and force HTTPS in production so forms are always submitted securely.
        $middleware->append(\App\Http\Middleware\TrustProxies::class);
        $middleware->append(\App\Http\Middleware\ForceHttps::class);


        $middleware->group('group_middleware', [
            //middleware group
             \App\Http\Middleware\MiddlewareOne::class,
             \App\Http\Middleware\MiddlewareTwo::class,
        ]);


        $middleware->alias([
            //route middleware
            'maintenance' => App\Http\Middleware\DownForMaintenanceMw::class,
            'sessionUserAccount' => App\Http\Middleware\SessionUserAccountMW::class,
            'checkAdminRole' => App\Http\Middleware\CheckAdminRole::class,
            'forcePasswordChange' => App\Http\Middleware\ForcePasswordChange::class,
            'preventBackHistory' => App\Http\Middleware\PreventBackHistory::class,


        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //alias route middle
    })->create();
