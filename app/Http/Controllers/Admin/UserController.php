<?php

namespace App\Http\Controllers\Admin;

use App\Model\User;
use App\Model\Role;
use App\Model\Permission;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Crypt;

class UserController extends Controller
{
    /**
     * 用户列表
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //统计
        $total = User::count();
        //获取提交的请求参数
        $input = $request->all();
        $data = User::orderBy('user_id','DESC')
            ->where(function($query) use($request){
                $username = $request->input('username');
                $email = $request->input('email');
                if (!empty($username)) {
                    $query->where('user_name','like','%'.$username.'%');
                }
                if (!empty($email)) {
                    $query->where('email','like','%'.$email.'%');
                }                
            })
            ->paginate($request->input('num')?$request->input('num'):3);
        return view('admin.user.list',['user'=>$data,'request'=>$request,'total'=>$total]);
    }

    /**
     * 添加用户
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.user.add');
    }

    /**
     * 执行添加操作
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //1.接受前台表单提交数据
        $input = $request->all();
        //2.进行表单验证

        //3.添加到数据库
        $username = $input['email'];
        $pass = Crypt::encrypt($input['pass']);
        $res = User::create(['user_name'=>$username,'user_pass'=>$pass,'email'=>$input['email']]);
        if ($res) {
            $data = [
                'status'=>0,
                'message'=>'添加成功'
            ];
        }else{
            $data = [
                'status'=>1,
                'message'=>'添加失败'
            ];          
        }
        return $data;
        //4.根据添加结果反馈json格式结果
    }

    /**
     * 单条数据显示
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * 执行修改页面.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        return view('admin.user.edit',['user'=>$user]);
    }

    /**
     * 执行修改操作
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //根据id获取要修改的数据
        $user = User::find($id);
        //获取要修改的用户名
        $username = $request->input('user_name');
        $user->user_name = $username;
        $res = $user->save();
        if ($res) {
            $data = [
                'status' => 0,
                'message'=> '修改成功'
            ];
        }else{
            $data = [
                'status' => 0,
                'message'=> '修改失败'
            ];            
        }
        return $data;
    }

    /**
     * 用户删除
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        $res = $user->delete();
        if ($res) {
            $data = [
                'status' => 0,
                'message'=> '删除成功'
            ];
        }else{
            $data = [
                'status' => 1,
                'message'=> '删除失败'
            ];            
        }
        return $data;        
    }

    //批量删除u
    public function delAll(Request $request)
    {
        $input = $request->input('ids');
        $res = User::destroy($input);
        if ($res) {
            $data = [
                'status' => 0,
                'message'=> '删除成功'
            ];
        }else{
            $data = [
                'status' => 1,
                'message'=> '删除失败'
            ];            
        }
        return $data;             
    }

    //启用
    public function start($id)
    {
        $user = User::find($id);
        $res = $user->update(['status'=>1]);
        if ($res) {
            $data = [
                'status' => 0,
                'message'=> '启用成功'
            ];
        }else{
            $data = [
                'status' => 1,
                'message'=> '启用失败'
            ];            
        }
        return $data;             
    }

    //停用
    public function stop($id)
    {
        $user = User::find($id);
        $res = $user->update(['status'=>0]);
        if ($res) {
            $data = [
                'status' => 0,
                'message'=> '停用成功'
            ];
        }else{
            $data = [
                'status' => 1,
                'message'=> '停用失败'
            ];            
        }
        return $data;                   
    } 

    //角色管理
    public function auth($id)
    {
        //获取当前用户
        $user = User::find($id);
        //获取所有的角色列表
        $role = Role::get();
        //获取当前角色拥有的权限
        $own_perms = $user->userrole;
        //角色拥有的权限的id
        // var_dump($own_perms);exit;
        $own_pers = array();
        foreach ($own_perms as $v) {
            $own_pers[] =$v->id;
        }
        return view('admin.user.auth',['user'=>$user,'role'=>$role,'own_pers'=>$own_pers]);
    }

    //执行角色处理
    public function doauth(Request $request)
    {
        $input = $request->except('_token');
        //删除当前角色已有的权限
        \DB::table('user_role')->where('user_id',$input['user_id'])->delete();
        //添加新授予的权限
        if (!empty($input['role_id'])) {
            foreach ($input['role_id'] as $v) {
            \DB::table('user_role')->insert(['user_id'=>$input['user_id'],'role_id'=>$v]);
            }
        }

        return redirect('admin/user')->withErrors('授权成功');
    }               
}
