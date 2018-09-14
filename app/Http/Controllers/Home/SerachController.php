<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Article;
use Mail;

class SerachController extends CommonController
{
    //搜索页面
    public function serach(Request $request)
    {
    	$input = $request->all();
    	$lists = Article::orderBy('art_id','asc')
            ->where(function($query) use($request){
                $art_title = $request->input('serach');
                if (!empty($art_title)) {
                    $query->where('art_title','like','%'.$art_title.'%');
                }              
            })
            ->paginate(10);
        $total = count($lists);
    	return view('home.serach',['lists'=>$lists,'total'=>$total,'request'=>$request]);
    }

    //邮件订阅
    public function subscribe(Request $request)
    {
    	$input = $request->all();
    	$input['status'] = 1;
    	$sub = \DB::table('subscribe')->where('email',$input['email'])->first();	
    	if (!is_object($sub)) {
			$res = \DB::table('subscribe')->insert(['email'=>$input['email'],'status'=>0]);
	    	if ($res) {
	    		$data = [
	    			'status' => 0,
	    			'msg'    => '你已成功订阅该栏目，同时你也会收到一封提醒邮件'
	    		];
	    		//订阅成功后，发送提醒邮件
				Mail::send('email.subscribe',['email'=>$input['email']],function ($m) use ($input) {
                	$m->to($input['email'], $input['email'])->subject('订阅成功');
            	});	    		
	    	}else{
				$data = [
	    			'status' => 1,
	    			'msg'    => '订阅失败'
	    		];   		
	    	}    		
    	}else{
			$data = [
    			'status' => 1,
    			'msg'    => '您已经订阅过了,请勿重复提交'
    		];       		
    	}
    	
    	return $data;
    }

    
    //邮件退订
    public function tuiding()
    {
        return view('home.tuiding');
    }

    //处理退订
    public function dotuiding(Request $request)
    {
        $input = $request->except('_token');
        $sub = \DB::table('subscribe')->where('email',$input['user_name'])->first();
        if (!$sub) {
            return back()->with('msg','您还没有订阅,哪来的退订');
        }
        $res = \DB::table('subscribe')->where('email',$input['user_name'])->delete();
        if ($res) {
            return back()->with('msg','退订成功,请点击左上角LOGO返回博客');
        }else{
            return back()->with('msg','退订失败,请重试');
        }
    }
}
