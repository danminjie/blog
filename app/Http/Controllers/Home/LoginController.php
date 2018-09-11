<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\HomeUser;
use Illuminate\Support\Facades\Crypt;
use Mail;
class LoginController extends CommonController
{
    //
    public function login()
    {
    	return view('home.login');
    }

    //处理登录
    public function dologin(Request $request)
    {
    	$input = $request->except('_token');
    	$username = $input['user_name'];
        $password = $input['user_pass'];
        //记住7天
        $timeout = time() + 60*60*24*7;
        
//        3. 验证用户是否存在
        $user = HomeUser::where('user_name',$input['user_name'])->first();
		if(empty($user)){
            return redirect('login')->with('msg','用户名不存在');
        }
        //4. 密码是否正确
		if($input['user_pass'] !=  Crypt::decrypt($user->user_pass) ){
            return redirect('login')->with('msg','密码不对');
        }
        if ($user->active == 0) {
        	return redirect('login')->with('msg','账号未激活请去邮箱激活');
        }                
		if(isset($input['rememberme'])){
            setcookie('username', "$username", $timeout);
            setcookie('password', "$password", $timeout);
        }else{
            setcookie('username', "", time()-1);
            setcookie('password', "",time()-1);
        }   
        //如果登录成功，将登录用户信息保存到session中
        session()->put('homeuser',$user);
        return redirect('index');
    }

    //手机注册
    public function phoneregister()
    {
    	return view('home.phoneregister');
    }

    //检测手机号是否存在
    public function exists(Request $request)
    {
    	$input = $request->input('user_name');
    	$res = HomeUser::where(['user_name'=>$input])->get()->toArray();
    	if ($res) {
            $data = [
                'status'=>0,
                'message'=>'账号已存在'
            ];
        }else{
            $data = [
                'status'=>1,
                'message'=>'账号不存在'
            ];          
        }
    	return $data;
    }
    //处理手机注册
    public function dophoneregister(Request $request)
    {
    	$input = $request->except('_token');
        //如果验证码不对
        if(session()->get('phone') != $input['code']){
           return redirect('phoneregister')->with('active','验证码错误,请重试');
        }
        //加密密码
        $input['user_pass'] = Crypt::encrypt($input['user_pass']);
        $input['user_name'] = $input['user_name'];
        //设置过期时间
        $input['expire'] = time()+3600*24;
        //插入到数据库,手机号注册的直接是激活状态
        $user = HomeUser::create(['user_name'=>$input['user_name'],'phone'=>$input['user_name'],'user_pass'=>$input['user_pass'],'active'=>1]);
        if($user){
            return redirect('login')->with('active','注册成功,请登录');
        }else{
            return back()->with('active','注册失败,请重试');
        }
    }

    //邮箱注册
    public function mailregister()
    {
    	return view('home.mailregister');
    }

    //处理邮箱注册
    public function domailregister(Request $request)
    {	
		$input = $request->except('_token');
		//加密密码
        $input['user_pass'] = Crypt::encrypt($input['user_pass']);
        //将邮箱字段赋值
        $input['email'] = $input['user_name'];
        //token码
        $input['token'] = md5($input['email'].$input['user_pass'].'123');
        //过期时间
        $input['expire'] = time()+3600*24*7;

        $user = HomeUser::create($input)->toArray();
        // var_dump($user);exit;
        if($user){
        	//@param1 模板文件  @param2 需要发送到模板的值 $m-to(发件人，发件人的名字)
            Mail::send('email.active',['user'=>$user],function ($m) use ($user) {
                $m->to($user['email'], $user['user_name'])->subject('激活邮箱');
            });
            return redirect('login')->with('active','请先登录邮箱激活账号');
        }else{
            return redirect('emailregister');
        }  	
    }

    //找回密码选项
    public function forget()
    {
    	return view('home.forget');
    }

    //手机找回密码
    public function phoneforget()
    {
    	return view('home.phoneforget');
    }

	//处理手机找回密码
    public function dophoneforget(Request $request)
    {
    	$input = $request->except('_token');
    	// var_dump($input);
    	if(session()->get('phone') != $input['code']){
           return redirect('phoneforget')->with('active','验证码错误,请检查');
        }
        $user = HomeUser::where(['user_name'=>$input['user_name']])->first();
        $input['user_pass'] = Crypt::encrypt($input['user_pass']);
        $res = $user->update(['user_pass'=>$input['user_pass']]);
        if ($res) {
        	return redirect('login')->with('active','密码找回成功,请登录');
        }else{
        	return redirect('phoneforget')->with('active','找回失败,请重试');
        }
    }    

	//手机找回密码
    public function mailforget()
    {
    	return view('home.mailforget');
    } 

    //执行提交的邮箱
    public function domailforget(Request $request)
    {
    	$input = $request->except('_token');
    	$user = HomeUser::where('user_name',$input['user_name'])->first()->toArray();
    	// var_dump($user);exit;
		//@param1 模板文件  @param2 需要发送到模板的值 $m-to(发件人，发件人的名字)
        Mail::send('email.forget',['user'=>$user],function ($m) use ($user) {
            $m->to($user['email'], $user['user_name'])->subject('找回密码');
        });
        return view('error.success')->with('msg','发送邮件成功，请登录邮箱重置密码');    	
    }

    //邮件重置密码页面
    public function reset(Request $request)
    {
    	$input = $request->all();
    	$user = HomeUser::where('user_id',$input['uid'])->first()->toArray();
    	if ($user['token'] != $input['token']) {
    		return view('error.error')->with('msg','请从邮箱中点击连接找回密码'); 
    	}else{
    		return view('home.reset',['user'=>$user]);
    	}
    }

	//处理密码重置
    public function doreset(Request $request)
    {
    	$input = $request->except('_token');
    	$input['user_pass'] = Crypt::encrypt($input['user_pass']);
    	$user = HomeUser::where('user_id',$input['user_id'])->first();
    	$res = $user->update($input);
    	if ($res) {
    		return redirect('login')->with('msg','密码重置成功,请登录');
    	}else{
    		return back()->with('msg','重置密码失败,请重试');
    	}
    }    
    //邮件激活
    public function active(Request $request)
    {
    	$user = HomeUser::findOrFail($request->userid);
    	//验证token的有效性，保证链接是通过邮箱中的激活链接发送的
        if ($request->token != $user->token){
        	return view('error.error',['msg'=>'当前链接非有效链接,请从邮箱中点击激活']);
        }
        //判断是否超时
        if (time() > $user->expire) {
        	return '激活已超时,请重新申请';
        }

        $res = $user->update(['active'=>1]);
        if($res){
            return redirect('login')->with('msg','账号激活成功,请登录');
        }else{
            return '邮箱激活失败，请检查激活链接，或者重新注册账号';
        }
    }

    //发送短信
	public function sendsms(Request $request)
    {
    	//获取手机号
    	$phone = $request->input('phone');
    	//随机验证码
    	$code = rand(1000,9999);
    	//验证码存入session
    	session()->put('phone',$code);
        //模板ID
        $tempid = '365738';
        //调用公共方法的云之讯短信接口发送
    	$res = sendDuanxin($phone,$code,$tempid);
    	//转换成json格式
    	$array = json_decode($res,TRUE);
    	return $array;
    }    

	//退出登录
	public function logout()
	{
		session()->flush('homeuser');
		//跳转到登录页面
		return redirect('index');
	}    
}
