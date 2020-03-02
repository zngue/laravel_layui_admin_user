<?php


namespace Zngue\User\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Zngue\User\Helper\Helpers;

class UserLogin
{
    use Helpers;
    public function handle( Request $request, Closure $next)
    {
        if ($request->ajax()){
            if (!Auth::user()){
                return $this->returnError('登录失效请重新登录',4001200);
            }
        }else{
            if (!(Auth::user())) {
                return redirect()->route('login.index');
            }
        }
        return $next($request);
    }
}
