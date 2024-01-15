<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class UserAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
      if( Auth::check() )
      {
          /** @var User $user */
          $user = Auth::user();
          if ( $user->hasRole('super_admin') ) {
              return redirect(route('superAdmin-dashboard'));
          }
          else if ( $user->hasRole('manager') ) {
              return redirect(route('manager-dashboard'));
          }
          else if ( $user->hasRole('user') ) {
              return $next($request);
          }
      }

        abort(403);
    }
}
