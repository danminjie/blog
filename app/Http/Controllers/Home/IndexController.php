<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Cate;
use App\Model\Article;
use App\Model\Collect;
use App\Model\Comment;
use App\Model\Love;


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

    //喜欢
    public function love(Request $request)
    {
        //获取参数
        $uid = $request->input('uid');
        $artid = $request->input('artid');
        $act = $request->input('act');
        //判断是加入收藏还是取消先收藏
        switch ($act) {
            //收藏操作
            case 'love':
                //判断是否已经收藏过
                $collect = Love::where([
                    ['uid','=',$uid],
                    ['art_id','=',$artid]
                ])->get();
               //未被收藏过了
               if($collect->isEmpty()){
                   //添加收藏记录
                    $res = Love::create(['uid'=>$uid,'art_id'=>$artid]);
                    Article::where('art_id',$artid)->increment('art_love');
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
            case 'unlove':
                //判断是否已经收藏过
                $collect = Love::where([
                    ['uid','=',$uid],
                    ['art_id','=',$artid]
                ])->first();
                //已收藏
                if(!empty($collect)){
                    //文章收藏数量减1
                    Article::where('art_id',$artid)->decrement('art_love');
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
    	$lists = Article::orderBy('art_status','DESC')->where('cate_id',$id)->paginate(5);
    	$catename = Cate::find($id);
    	return view('home.lists',['lists'=>$lists,'catename'=>$catename]);
    }

    //详情
    public function detail(Request $request,$id)
    {
        //统计留言
        $total = Comment::where(['post_id'=>$id])->count();
        //获取留言列表
        $msg = Comment::orderBy('create_time','DESC')->where(['parent_id'=>0,'post_id'=>$id])->paginate(100);
        //文章的查看次数+1
        \DB::table('article')
            ->where('art_id', $id)
            ->increment('art_view');
        //获取指定id的文章
        $art = Article::where('art_id',$id)->first();
        //获取当前文章的类别
        $catename = Cate::where('cate_id',$art->cate_id)->first();
        // var_dump($catename);exit;
        //获取相关文章内容
        $about = Article::where('cate_id',$art->cate_id)->take(4)->get()->toArray();
        //上一篇
        $prev = Article::where('art_id','<',$id)->orderBy('art_id','desc')->first();
        //下一篇
        $next = Article::where('art_id','>',$id)->orderBy('art_id','asc')->first();

        return view('home.detail',['art'=>$art,'catename'=>$catename,'about'=>$about,'prev'=>$prev,'next'=>$next,'total'=>$total,'msg'=>$msg]);
    }

    //处理留言内容
    public function dodetmsg(Request $request)
    {
        $input = $request->except('_token');
        $input['create_time'] = time();
        $input['parent_id']   = 0;
        $res = Comment::insert($input);
        if ($res) {
            return back()->with('msg','留言成功,自行刷新查看');
        }else{
            return back()->with('msg','留言失败,请重试,谢谢！');
        }
    }

    //处理留言回复
    public function dotmsghuifu(Request $request)
    {
        $input = $request->except('_token');
        $input['create_time'] = time();
        $res = Comment::insert($input);
        if ($res) {
            return back()->with('msg','留言成功,自行刷新查看');
        }else{
            return back()->with('msg','留言失败,请重试,谢谢！');
        }
    }       

}
