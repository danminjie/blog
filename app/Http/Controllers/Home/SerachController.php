<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Article;

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
}
