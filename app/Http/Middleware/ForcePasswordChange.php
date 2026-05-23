<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\UserAccount;
use Illuminate\Support\Facades\Session;

class ForcePasswordChange
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        // Allow access to change password, login, and logout pages
        $allowed_routes = [
            'user.show-change-password',
            'user.update-password',
            'user.logout',
            '/'
        ];

        // Check if current route is in allowed list
        $current_route = $request->route()?->getName();
        if (in_array($current_route, $allowed_routes)) {
            return $next($request);
        }

        // Check if user is logged in
        if (!Session::has('user_id')) {
            return redirect('/');
        }

        // Check if user is a student
        if (Session::get('logged_role') !== 'student') {
            return $next($request);
        }

        // Get the user account
        $user = UserAccount::find(Session::get('user_id'));

        // If password hasn't been changed, force redirect to change password
        if ($user && !$user->password_changed) {
            return redirect('/change-password')->with('first_login', true);
        }

        return $next($request);
    }
}
