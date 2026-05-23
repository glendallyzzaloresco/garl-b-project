<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ForceHttps
{
    /**
     * Redirect HTTP requests to HTTPS in production.
     */
    public function handle(Request $request, Closure $next)
    {
        if (!app()->environment('production')) {
            return $next($request);
        }

        $forwardedProto = strtolower((string) $request->header('x-forwarded-proto', ''));
        $isHttps = $request->secure() || $forwardedProto === 'https';

        if (!$isHttps) {
            $target = 'https://' . $request->getHttpHost() . $request->getRequestUri();
            return redirect()->to($target, 301);
        }

        return $next($request);
    }
}
