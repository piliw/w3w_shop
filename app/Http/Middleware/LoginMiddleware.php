<?php

namespace App\Http\Middleware;

use Closure;

class LoginMiddleware
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
        // $request 请求报文
        //检测用户是否具有登录的session
        if($request->session()->has('username')){
            // 4获取访问模块的控制器和方法 和权限对比
            // 获取方法和控制器
            // $action = $request->route()->getActionMethod();
            // // echo $action;
            //  //获取控制器名字
            // $actions=explode('\\', \Route::current()->getActionName());
            // //或$actions=explode('\\', \Route::currentRouteAction());
            // $modelName=$actions[count($actions)-2]=='Controllers'?null:$actions[count($actions)-2];
            // $func=explode('@', $actions[count($actions)-1]);
            // $controllerName=$func[0];
            // $actionName=$func[1];
            // // echo $controllerName.":".$action;
            // //获取权限列表
            // $nodelist=session('nodelist');
            // //对比   控制器是否存在  方法是否存在
            // if(empty($nodelist[$controllerName])|| !in_array($action,$nodelist[$controllerName])){
            //    return back()->with('error','抱歉,您没有权限访问该模块,请联系超级管理员');  
            // }
            return $next($request);
        }else{
            //跳转到登录界面
            return redirect("/login");
        }
    }
}
