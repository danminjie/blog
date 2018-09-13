<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Org\code\Code;
use Gregwar\Captcha\CaptchaBuilder; 
use Gregwar\Captcha\PhraseBuilder;
use App\Model\User;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
class LoginController extends Controller
{
    //后台登录页
    public function login()
    {
    	return view('admin.login');
    }

    //验证码
    public function code()
    {
    	$code = new Code();
    	return $code->make();
    }

    // 验证码生成
	public function captcha($tmp)
	{
	    $phrase = new PhraseBuilder;
	    // 设置验证码位数
	    $code = $phrase->build(4);
	    // 生成验证码图片的Builder对象，配置相应属性
	    $builder = new CaptchaBuilder($code, $phrase);
	    // 设置背景颜色
	    $builder->setBackgroundColor(220, 210, 230);
	    $builder->setMaxAngle(25);
	    $builder->setMaxBehindLines(0);
	    $builder->setMaxFrontLines(0);
	    // 可以设置图片宽高及字体
	    $builder->build($width = 100, $height = 40, $font = null);
	    // 获取验证码的内容
	    $phrase = $builder->getPhrase();
	    // 把内容存入session
	    \Session::flash('code', $phrase);
	    // 生成图片
	    header("Cache-Control: no-cache, must-revalidate");
	    header("Content-Type:image/jpeg");
	    $builder->output();
	}

	//执行登录
	public function do_login(Request $request)
	{
		//接受表单提交数据
		$input = $request->except('_token');
		//进行表单验证
		// $validator = Validator::make('需要验证表单数据','验证规则','错误提示信息');
		$rule = [
			'username'=>'required|between:4,18',
			'password'=>'required|between:4,18|alpha_dash',
		];
		$msg = [
			'username.required'=>'用户名必须输入',
			'username.between'=>'用户名必须在6-18位之间',
			'password.required'=>'密码必须输入',
			'password.between'=>'密码名必须在6-18位之间',
			'password.alpha_dash'=>'密码必须是数字字母下划线',
		];
		$validator = Validator::make($input,$rule,$msg);
		//验证码验证
	    if (strtolower($input['code']) != strtolower(\Session::get('code'))) {
	        return back()
	            ->withErrors('验证码错误!');
	    }else{
			if ($validator->fails()) {
				return redirect('admin/login')->withErrors($validator)->withInput();
			}else{
				//3.验证是否有此用户
				$user = User::where('user_name',$input['username'])->first();
				// var_dump($user);
				if ($input['username'] != $user->user_name) {
					return redirect('admin/login')->withErrors('不存在该用户')->withInput();
					// return redirect('admin/login')->withErrors($user);
				}else if($input['password'] != Crypt::decrypt($user->user_pass)){
					return redirect('admin/login')->withErrors('密码不正确')->withInput();
				}else{
					//4.保存用户信息到session中
					session()->put('user',$user);
					session()->put('islogin',1);
					$log['user_name'] = $user->user_name;
					$log['logintime'] = time();
					$log['ip'] 		  = $_SERVER["REMOTE_ADDR"];
					\DB::table('loginlog')->insert($log);
					//5.跳转到后台首页		
					return redirect('admin/index');			
				}

				
			}	    	
	    }
	}

	//后台首页
	public function index()
	{
    	return view('admin.index');
	}

	//后台欢迎页
	public function welcome()
	{
		//获取最近登录的一条记录
		$log = \DB::table('loginlog')->orderBy('id','DESC')->first();
		//获取会员总数
		$usertotal = \DB::table('homeuser')->count();
		//文章总数
		$arttotal = \DB::table('article')->count();
		//管理员总数
		$admintotal = \DB::table('user')->count();
		$permission = \DB::table('permission')->count();
		$role = \DB::table('role')->count();

    	return view('admin.welcome',[
    		'log'       => $log,
    		'usertotal' => $usertotal,
    		'arttotal'  => $arttotal,
    		'admintotal'=> $admintotal,
    		'permission'=> $permission,
    		'role'      => $role,
    	]);
	}	

	//退出登录
	public function logout()
	{
		session()->flush('user');
		//跳转到登录页面
		return redirect('admin/login');
	}

	//没有权限对应的跳转
	public function noaccess()
	{
		return view('admin.errors.noaccess');
	}
	//加密算法
	public function jiami()
	{
		//md5加密
		// $str = 'yan'.'123456';
		// return md5($str);
		
		//哈希加密
		// $str = '123456';
		// $hash = Hash::make($str);
		// if (Hash::check($str,$hash)) {
		// 	return '密码正确';
		// }else{
		// 	return '密码错误';
		// }

		//crypt 加密
		// $str = '123456';
		// $crypt = Crypt::encrypt($str);
		// return $crypt;
		//解密
		$crypt_str = 'eyJpdiI6InRmMnFtZ3U0eGt6UHo3SVpYU083Z1E9PSIsInZhbHVlIjoiSlk3V1k2NTdCR0NMTTlaT0RXbG15Zz09IiwibWFjIjoiMTBiMmUwNjNlY2I2NTJmY2Y3MmJiM2U5Yzc2ODM2YTNlYTY0N2U5OTQ2MmJlYzg1MDk4ODA5ZjcxNzc0M2FmMSJ9';
		$res = Crypt::decrypt($crypt_str);
		var_dump($res);
	}
}
