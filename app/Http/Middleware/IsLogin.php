<?php

namespace App\Http\Middleware;

use Closure;

class IsLogin
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
        if (session()->get('user') && session()->get('islogin')) {
            return $next($request);
        }else{
            return redirect('admin/login')->withErrors('没登录不能访问，谢谢合作');
        }
        
    }
}
