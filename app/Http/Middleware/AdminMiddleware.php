<?php

namespace App\Http\Middleware;

use App\Constants\UserRole;
use Closure;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $user = \Auth::user();
        if(isset($user) && $user->role == UserRole::admin) {
            return $next($request);
        }
        return redirect('/');
    }
}
