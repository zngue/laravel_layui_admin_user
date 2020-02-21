<?php


namespace Zngue\User\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class UserLogin
{
    public function handle($request, Closure $next)
    {
        if (!(Auth::user())) {
            return redirect()->route('login.index');
        }
        return $next($request);
    }
}
