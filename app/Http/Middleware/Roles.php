<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class Roles
{
    /**
     * Handle an incoming request.
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  mixed  ...$roles
     */

    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        if(!Auth::check()){
            return abort(403, 'Unauthorized');
;
        }
        $user = Auth::user();
        if (!in_array($user->role_id, $roles)) {
            return abort(403, 'Unauthorized');
;
        }
        return $next($request);
    }
}
