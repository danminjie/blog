<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Cate;
use App\Model\Article;
use App\Model\Link;
class CommonController extends Controller
{
    //构造函数
    public function __construct()
    {
    	//获取类别
		$cate = Cate::orderBy('cate_order','asc')->get();
        //存放一级类变量
        $cateone = [];
        //存放二级类变量
        $catetwo = [];
        foreach ($cate as $k=>$v)
         {
            //取出一级类存放到cateone
            if($v->cate_pid == 0){
                $cateone[$k] = $v;
                //获取当前一级的二级类
                foreach($cate as $m=>$n){
                    if($v->cate_id == $n->cate_pid){
                       $catetwo[$k][$m]=$n;
                   }
                }
            }
        }
        
        //获取标签
        $tags = Article::pluck('art_tag','art_id')->all();
        $tagtotal = Article::pluck('art_tag','art_id')->count();
        //去除重复的
        $tags = array_unique($tags);

        //获取友情链接
        $links = Link::get();
        //将大类传入公共变量
        view()->share('cateone',$cateone);
        //小类传入公共变脸
        view()->share('catetwo',$catetwo);    
        //将标签传入公共变量	
        view()->share('tags',$tags);   
        //将友情链接传入公共变量
        view()->share('links',$links);              
        view()->share('tagtotal',$tagtotal);          	
    }

}
