<?php

namespace App\Http\Middleware;

use Closure;
use App\Model\User;
use App\Model\Role;
use App\Model\Permission;
class HasRole
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
        $quanxian = \DB::table('user')->where('user_id',session()->get('user')->user_id)->first();
        if ($quanxian->user_id == 1) {
            return $next($request);
        }else{
            //获取当前请求的路由 对应的控制器方法名
            $rote = \Route::current()->getActionName();
            //2. 获取当前用户的权限组
            $user = User::find(session()->get('user')->user_id);
            //2.1 获取当前用户的角色userrole 是关联模型
            $roles = $user->userrole;
            // dd($roles);
            //根据用户拥有的角色找对应的权限
            //存放权限的per_url
            $arr = [];
            foreach ($roles as $v){
                $perms =   $v->permission;
                foreach ($perms as $perm){
                    $arr[] = $perm->per_url;
                }
            }
            // dd($arr);
            //去掉重复的权限
            $arr = array_unique($arr);
            //判断当前请求的路由对应控制器方法名是否在当前用户拥有的arr中
            if(in_array($rote,$arr)){
                return $next($request);
            }else{
                return redirect('noaccess');
            }
            
        }            
    }
        
}
