<?php

namespace App\Http\Middleware;

use App\Models\User;
use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response) $next
     */
    public function handle(Request $request, Closure $next, string ...$guards): Response
    {
        $guards = empty($guards) ? [null] : $guards;
        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                /** @var User $user */
                $user = Auth::user();

                // to admin dashboard
                if ($user->hasRole('super_admin')) {
                    return redirect(route('superAdmin-dashboard'));
                } // to user dashboard
                else if ($user->hasRole('user')) {
                    return redirect(route('user-dashboard'));
                } // to manager dashboard
                else if ($user->hasRole('manager')) {
                    return redirect(route('manager-dashboard'));
                }
            }
        }

        return $next($request);
    }
}
