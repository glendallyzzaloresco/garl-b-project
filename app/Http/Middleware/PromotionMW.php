<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PromotionMW
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Share promotion data with all views
        view()->share('promotion', [
            'discount' => '50%',
            'title' => '50% Off on All Items',
            'description' => "Don't miss out on this amazing promotion!",
            'date' => 'May 5, 2026',
            'badge' => 'Limited Time Offer',
            'active' => true
        ]);

        return $next($request);
    }
}
