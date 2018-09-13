<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Message;

class MessageController extends CommonController
{
    //留言视图
    public function message()
    {
    	$total = Message::count();
    	$msg = Message::orderBy('create_time','DESC')->where('parent_id',0)->paginate(5);
    	return view('home.liuyan',['total'=>$total,'msg'=>$msg]);
    }

    //处理留言内容
    public function domessage(Request $request)
    {
        $input = $request->except('_token');
        $input['create_time'] = time();
        $res = Message::insert($input);
        if ($res) {
        	return back()->with('msg','留言成功,自行刷新查看');
        }else{
        	return back()->with('msg','留言失败,请重试,谢谢！');
        }
    }

    //处理留言回复
    public function messagehuifu(Request $request)
    {
    	$input = $request->except('_token');
    	$input['create_time'] = time();
        $res = Message::insert($input);
        if ($res) {
        	return back()->with('msg','留言成功,自行刷新查看');
        }else{
        	return back()->with('msg','留言失败,请重试,谢谢！');
        }
    }	
}
