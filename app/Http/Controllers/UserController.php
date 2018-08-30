<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\User_add;
class UserController extends Controller
{
    //添加方法
    /**
     * 获取一个添加页面
     * @param null
     * @retrun 返回添加页面
     */
    public function add()
    {
    	//返回添加页面
    	return view('user.add');
    }
	/**
     * 执行用户添加操作
     * @param 提交的表单数据
     * @retrun 返回添加是否成功
     */
    public function insert(Request $request)
    {
    	//获取客户端提交的表单数据
    	$input = $request->except('_token');
    	$input['password'] = md5($input['password']);
    	//表单验证
    	//添加操作
    	$res = Db::table('blog_user')->insertGetId($input);
    	// $res = User_add::create($input);
    	//判断是否添加成功
    	if ($res) {
    		return redirect('user/index');
    	}else{
    		back();
    	}
    }    

    //用户列表页
    public function index()
    {
    	$user = User_add::get();
    	// dd($user);
    	//返回用户列表
    	return view('user.list',['user'=>$user]);
    }

    //用户修改
    public function edit($id)
    {
    	//找到需要修改用户数据
    	$user = User_add::find($id);
    	//返回修改页面
    	return view('user.edit',['user'=>$user]);
    }

    //执行修改
    public function update(Request $request)
    {
    	//接收参数
    	$input = $request->except('_token');
    	//找到需要修改的会员对象
    	$user = User_add::find($input['id']);
    	//将提交过来的数据修改
    	$res = $user->update(['username'=>$input['username']]);
    	if ($res) {
    		return redirect('user/index');
    	}else{
    		return back();
    	}
    }

    //用户删除
    public function del($id)
    {
    	$user = User_add::find($id);
    	$res = $user->delete();
    	if ($res) {
    		$data = [
    			'status'=>0,
    			'message'=>'删除成功'
    		];
    	}else{
				$data = [
    			'status'=>1,
    			'message'=>'删除失败'
    		];    		
    	}
    	return $data;
    }
}
