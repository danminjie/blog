<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Org\code\Code;
use Gregwar\Captcha\CaptchaBuilder; 
use Gregwar\Captcha\PhraseBuilder;
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
		if ($validator->fails()) {
			return redirect('admin/login')->withErrors($validator)->withInput();
		}
	}
}
