<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class DownForMaintenanceMw
{
    /**
     * Pages/URIs that should display the maintenance overlay.
     *
     * Add a page path here to enable maintenance on that page.
     * Remove it from this list to return that page to normal.
     * 
     * Examples:
     * 'home'              - matches /home
     * 'students'          - matches /students, /students/1, /students/edit, etc. (uses startsWith)
     * 'degrees'           - matches /degrees, /degrees/1, /degrees/edit, etc.
     * 'posts'             - matches /posts, /posts/1, etc.
     * 'dashboard'         - matches /dashboard
     */
    protected array $maintenancePages = [
       // 'students',
    //    'degrees',
    ];

    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if current path matches any maintenance pages
        if ($this->shouldDisplayMaintenance($request)) {
            return redirect('/maintenance');
        }

        return $next($request);
    }

    /**
     * Check if the current request path should display maintenance overlay.
     *
     * @param Request $request
     * @return bool
     */
    private function shouldDisplayMaintenance(Request $request): bool
    {
        $currentPath = $request->path();

        foreach ($this->maintenancePages as $page) {
            // Exact match or starts with (for nested routes)
            if ($currentPath === $page || str_starts_with($currentPath, $page . '/')) {
                return true;
            }
        }

        return false;
    }
}
