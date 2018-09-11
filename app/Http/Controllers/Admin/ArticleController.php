<?php

namespace App\Http\Controllers\Admin;

use App\Model\Article;
use App\Model\Cate;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Image;
use Markdown;
use App\Services\OSS;
use Storge;
use \Illuminate\Support\Facades\Redis;
class ArticleController extends Controller
{
    //将markdown语法的内容转化为html语法
    public function pre_mk(Request $request)
    {
        return Markdown::convertToHtml($request->input('cont'));
    }
    //文件上传
    public function upload(Request $request)
    {
        //获取上传文件
        $file = $request->file('photo');
        //判断文件是否有效
        if (!$file->isValid()) {
            return response()->json(['ServerNo'=>400,'ResultData'=>'无效的上传文件']);
        }

        $ext = $file->getClientOriginalExtension();    //文件拓展名
        $newfile = date('Y-m-d-H-i-s').'-'.uniqid().'.'.$ext;  //新文件名
        //文件上传的指定路径
        $path = public_path('uploads');

        //将文件从临时目录移动到制定目录
        if (!$file->move($path,$newfile)) {
            return response()->json(['ServerNo'=>400,'ResultData'=>'保存文件失败']);
        }else{
            return response()->json(['ServerNo'=>'200','ResultData'=>$newfile]);
        }
        

        // 1.裁剪图片
        // $res = Image::make($file)->resize(100,100)->save($path.'/'.$newfile);
        // if ($res) {
        //     //成功
        //     return response()->json(['ServerNo'=>200,'ResultData'=>$newfile]);
        // }else{
        //     return response()->json(['ServerNo'=>400,'ResultData'=>'保存文件失败']);
        // }
        

        //2. 将文件上传到OSS的指定仓库
            //$osskey : 文件上传到oss仓库后的新文件名
            //$filePath:要上传的文件资源
            // $res = OSS::upload($newfile, $file->getRealPath());
            // if($res){
            // // 如果上传成功
            //     return response()->json(['ServerNo'=>'200','ResultData'=>$newfile]);
            // }else{
            //     return response()->json(['ServerNo'=>'400','ResultData'=>'上传文件失败']);
            // }            

        // //3. 将文件上传到七牛云存储的指定仓库
            //$qiniu = Storage::disk('qiniu');

            //$res = \Storage::disk('qiniu')->writeStream($newfile, fopen($file->getRealPath(), 'r'));
            
            //if($res){
            // 如果上传成功
            //    return response()->json(['ServerNo'=>'200','ResultData'=>$newfile]);
            //}else{
                //return response()->json(['ServerNo'=>'400','ResultData'=>'上传文件失败']);
            //}

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //使用redis
            // $listkey = 'LIST:ARTICLE'; //要存的id
            // $hashkey = 'HASH:ARTICLE'; //要存的文章
            // $arts = [];
            // if (Redis::exists($listkey)) {
            //     //存放所有要获取文章的id
            //     $lists = Redis::lrange($listkey,0,-1);
            //     foreach ($lists as $k => $v) {
            //         $arts[] = Redis::hgetall($hashkey.$v);
            //     }
            // }else{
            //     //获取数据库数据
            //     $arts = Article::get()->toArray();
            //     //将数据存入redis
            //     foreach ($arts as $k=>$v){
            //         //将文章的id添加到listkey变量中
            //         Redis::rpush($listkey,$v['art_id']);
            //         //将文章内容添加到hashkey变量中
            //         Redis::hmset($hashkey.$v['art_id'],$v);
            //     }
                
            //     //返回数据给客户端
            // }
        //统计
        $total = Article::count();
        //获取提交的请求参数
        $input = $request->all();
        $article = Article::orderBy('art_id','DESC')
            ->where(function($query) use($request){
                $arti_title = $request->input('arti_title');
                // $email = $request->input('email');
                if (!empty($arti_title)) {
                    $query->where('art_title','like','%'.$arti_title.'%');
                }
                // if (!empty($email)) {
                //     $query->where('email','like','%'.$email.'%');
                // }                
            })
            ->paginate($request->input('num')?$request->input('num'):8);
        return view('admin.article.list',['article'=>$article,'request'=>$request,'total'=>$total]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //获取分类
        $cates = (new Cate)->tree();
        return view('admin.article.add',['cates'=>$cates]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->except('_token','photo');
        // var_dump($input);exit;
//         $listkey = 'LIST:ARTICLE';
//         $hashkey = 'HASH:ARTICLE:';

//         $input = $request->except('_token','photo');
//         //添加时间
//         $input['art_time'] = time();
//         $input['art_view'] = 0;
//         $input['art_status'] = 0;

//         // 将提交的文章数据保存到数据库

//         $res = Article::create($input);

//         if($res){
// //            如果添加成功，更新redis
//             \Redis::rpush($listkey,$res->art_id);
//             \Redis::hMset($hashkey.$res->art_id,$res->toArray());

//             return redirect('admin/article');
//         }else{
//             return back();
//         }
        $input['art_time'] = time();
        $input['art_view'] = 0;
        $input['art_status'] = 0;

        // 将提交的文章数据保存到数据库

        $res = Article::create($input);
        if ($res) {
            return redirect('admin/article')->with('msg','添加文章成功');
        }else{
            return back()->input()->with('msg','添加文章成功');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //获取分类
        $cates = (new Cate)->tree();
        //获取单条记录
        $res = Article::find($id);
        return view('admin.article.edit',['res'=>$res,'cates'=>$cates]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $input = $request->except('_token');
        $art = Article::find($id);
        $res = $art->update($input);
        if($res){
            $data = [
                'status'=>0,
                'msg'=>'修改成功'
            ];
        }else{
//            return 2222;
            $data = [
                'status'=>1,
                'msg'=>'修改失败'
            ];
        }
        return $data;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $art = Article::find($id);
        $res = $art->delete();
        if ($res) {
            $data = [
                'status' => 0,
                'message'=> '删除成功'
            ];
        }else{
            $data = [
                'status' => 1,
                'message'=> '删除失败'
            ];            
        }
        return $data;   
        //
    }

    //加入推荐
    public function start($id)
    {
        $art = Article::find($id);
        $res = $art->update(['art_status'=>1]);
        if ($res) {
            $data = [
                'status' => 0,
                'message'=> '启用成功'
            ];
        }else{
            $data = [
                'status' => 1,
                'message'=> '启用失败'
            ];            
        }
        return $data;             
    }

    //取消推荐
    public function stop($id)
    {
        $art = Article::find($id);
        $res = $art->update(['art_status'=>0]);
        if ($res) {
            $data = [
                'status' => 0,
                'message'=> '停用成功'
            ];
        }else{
            $data = [
                'status' => 1,
                'message'=> '停用失败'
            ];            
        }
        return $data;                   
    }     
}
