<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Subemail;
use Mail;
class SubemailController extends Controller
{
    //订阅列表
    public function index()
    {
    	$email = Subemail::paginate(8);
    	$total = Subemail::count();
    	return view('admin.subemail.list',['email'=>$email,'total'=>$total]);
    }

    //删除订阅
    public function del($id)
    {
    	$email = Subemail::find($id);
        $res = $email->delete();
    	if ($res) {
    		$data = [
    			'status' => 0,
    			'msg'	 => '删除成功'
    		];
    	}else{
			$data = [
    			'status' => 1,
    			'msg'	 => '删除失败'
    		];    		
    	}
    	return $data;
    }

    //群发邮件
    public function allemail(Request $request)
    {
    	$input = $request->all();
    	$res = false;
    	foreach ($input['ids'] as $k => $v) {
    		//订阅成功后，发送提醒邮件
			Mail::send('email.allemail',['cont'=>$input['text']],function ($m) use ($v) {
        		$m->to($v, $v)->subject('通知邮件');
    		});
    		$res = true;    
    	}
		if ($res) {
    		$data = [
    			'status' => 0,
    			'msg'	 => '群发成功'
    		];
    	}else{
			$data = [
    			'status' => 1,
    			'msg'	 => '群发失败'
    		];    		
    	}
    	return $data;
    }
}
