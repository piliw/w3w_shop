<?php

namespace App\Http\Middleware;

use Closure;

class HomeloginMiddleware
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
        // 检测前台是否有登录的session用户
        if($request->session()->has('hname')){
            return $next($request);
        }else{
            // 跳转到登录界面
            return redirect("/homelogin");
        }
    }
}
