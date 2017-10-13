<?php

namespace App\Http\Middleware;

use Closure;

class LoginAuth
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
        if(!$request->session()->has('user')){
            if ($request->ajax()) {
                return response()->json(['status' => 200, 'msg' => '未授权，请登录！']);
            } else {
                return redirect()->route('Login.showLogin');
            }
        }

        return $next($request);
    }
}
