<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Cate;
use App\Model\Article;
use App\Model\Collect;


class IndexController extends CommonController
{
	//收藏
	public function collect(Request $request)
	{
		//获取参数
		$uid = $request->input('uid');
		$artid = $request->input('artid');
		$act = $request->input('act');
		//判断是加入收藏还是取消先收藏
		switch ($act) {
			//收藏操作
			case 'add':
				//判断是否已经收藏过
				$collect = Collect::where([
                    ['uid','=',$uid],
                    ['art_id','=',$artid]
                ])->get();
               //未被收藏过了
               if($collect->isEmpty()){
                   //添加收藏记录
                    $res = Collect::create(['uid'=>$uid,'art_id'=>$artid]);
                    Article::where('art_id',$artid)->increment('art_collect');
                    //如果收藏成功
                    if($res){
                        return response()->json(['status'=>0,'msg'=>'已收藏']);
                    }else{
                        return response()->json(['status'=>1,'msg'=>'收藏失败']);
                    }
               }else{
                   return response()->json(['status'=>0,'msg'=>'已收藏']);
               }

                break;
			
			//取消收藏操作
			case 'remove':
				//判断是否已经收藏过
				$collect = Collect::where([
                    ['uid','=',$uid],
                    ['art_id','=',$artid]
                ])->first();
                //已收藏
                if(!empty($collect)){
                	//文章收藏数量减1
                	Article::where('art_id',$artid)->decrement('art_collect');
                	//取消收藏
                	$res = $collect->delete();
                	if ($res) {
                		return response()->json(['status'=>0,'msg'=>'请收藏']);
                	}else{
                		return response()->json(['status'=>0,'msg'=>'取消收藏失败']);
                	}
                }else{
                	return response()->json(['status'=>0,'msg'=>'请收藏']);
                }			
				break;			

		}
	}

    //前台首页
    public function index()
    {
    	//获取相关二级类以及二级类下的文章
    	$cate_arts = Cate::orderBy('cate_order','asc')->where('cate_pid','<>',0)->with('article')->get()->toArray();
        // var_dump($cate_arts);exit;
    	return view('home.index',['cate_arts'=>$cate_arts]);
    }

    //列表页
    public function list($id)
    {
    	$lists = Article::orderBy('art_status','DESC')->where('cate_id',$id)->paginate(2);
    	$catename = Cate::find($id);	
    	return view('home.lists',['lists'=>$lists,'catename'=>$catename]);
    }

    //留言视图
    public function message()
    {
    	return view('home.liuyan');
    }

    //处理留言内容
    public function domessage()
    {

    }

}
