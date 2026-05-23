<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Session;

class PreventBackHistory
{
    /**
     * Prevent protected pages from being restored after logout.
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if user is logged in
        if (!Session::has('user_id')) {
            return redirect('/');
        }

        $response = $next($request);

        // Set multiple cache-control headers to prevent back button from loading cached pages
        $response->headers->set('Cache-Control', 'no-store, no-cache, must-revalidate, proxy-revalidate, max-age=0');
        $response->headers->set('Pragma', 'no-cache');
        $response->headers->set('Expires', 'Sat, 01 Jan 2000 00:00:00 GMT');
        $response->headers->set('Surrogate-Control', 'no-store');

        return $response;
    }
}
