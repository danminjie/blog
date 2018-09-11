<?php

namespace App\Http\Controllers\Admin;

use App\Model\Role;
use App\Model\Permission;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //统计
        $total = Role::count();
        //获取提交的请求参数
        $input = $request->all();
        $data = Role::orderBy('id','DESC')
            ->where(function($query) use($request){
                $role_name = $request->input('role_name');
                if (!empty($role_name)) {
                    $query->where('role_name','like','%'.$role_name.'%');
                }               
            })
            ->paginate($request->input('num')?$request->input('num'):3);
        return view('admin.role.list',['role'=>$data,'request'=>$request,'total'=>$total]);
    }

    /**
     * 权限添加页面
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //返回一个权限添加页面
        return view('admin.role.add');
    }

    /**
     * 执行添加
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //执行添加
        //获取表单数据
        $input = $request->except('_token');
        $input['create_time'] = time();
        //进行表单验证
        //通过模型将数据添加到role表
        $res = Role::create($input);
        if($res){
            return redirect('admin/role')->with('msg','添加成功');
        }else{
            return back()->with('msg','添加失败');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $role = Role::find($id);

        return view('admin.role.edit',['role'=>$role]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $input = $request->all();
        //使用模型修改表记录的两种方法,方法一
        // $role = Role::find($id);
        // $role->role_name = $input['role_name'];
        // $res = $role->save();
        $res = \DB::table('role')->where('id',$input['id'])->update(['role_name'=>$input['role_name']]);
        if($res){
            $data = [
                'status'=>0,
                'msg'=>'修改成功'
            ];
        }else{
            $data = [
                'status'=>1,
                'msg'=>'修改失败'
            ];
        }
        return $data;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //删除角色
        if (!empty($id)) {
            //删除角色
            \DB::table('role')->where('id',$id)->delete();
            //删除角色绑定的权限
            \DB::table('role_permission')->where('role_id',$id)->delete();
            //删除角色授权的用户
            \DB::table('user_role')->where('role_id',$id)->delete();
            $data = [
                'status'=>0,
                'msg'=>'删除成功'
            ];
        }else{
            $data = [
                'status'=>1,
                'msg'=>'删除失败'
            ];
        }
        return $data;
    }

    //获取授权页面
    public function auth($id)
    {
        //获取当前角色
        $role = Role::find($id);
        //获取所有的权限列表
        $per = Permission::get();
        //获取当前角色拥有的权限
        $own_perms = $role->Permission;
        //角色拥有的权限的id
        // var_dump($own_perms);exit;
        $own_pers = array();
        foreach ($own_perms as $v) {
            $own_pers[] =$v->id;
        }
        return view('admin.role.auth',['per'=>$per,'role'=>$role,'own_pers'=>$own_pers]);
    }

    //处理授权的方法
    public function doauth(Request $request)
    {
        $input = $request->except('_token');
        //删除当前角色已有的权限
        \DB::table('role_permission')->where('role_id',$input['role_id'])->delete();
        //添加新授予的权限
        if (!empty($input['permission_id'])) {
            foreach ($input['permission_id'] as $v) {
            \DB::table('role_permission')->insert(['role_id'=>$input['role_id'],'permission_id'=>$v]);
            }
        }

        return redirect('admin/role');
    }
}
