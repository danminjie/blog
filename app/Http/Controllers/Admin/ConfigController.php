<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Config;
use DB;

class ConfigController extends Controller
{
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
        $path = public_path('uploads/config');

        //将文件从临时目录移动到制定目录
        if (!$file->move($path,$newfile)) {
            return response()->json(['ServerNo'=>400,'ResultData'=>'保存文件失败']);
        }else{
            return response()->json(['ServerNo'=>'200','ResultData'=>$newfile]);
        }
    }  


    //将网站配置数据表中的网站配置数据写入config/webconfig.php文件中
    public function putContent()
    {
        //1. 从网站配置表中获取网站配置数据  pluck获取指定的字段
        $content = Config::pluck('conf_content','conf_name')->all();

        //2. 准备要写入的内容
        //var_export(内容,true)  转换成数组关联格式 'a'=>a
        $str = '<?php return '.var_export($content,true).';';

        //3. 将内容写入webconfig.php文件
        file_put_contents(config_path().'/webconfig.php',$str);
    }

    //批量修改功能
    public function changecontent(Request $request)
    {
        $input = $request->except('_token');
        // var_dump($input);exit;
        //开启事务处理
        DB::beginTransaction();
        try {
            //遍历提交过来的 conf_if数组
            foreach ($input['conf_id'] as $k => $v) {
                //每读取一条，就把表单的内容指定的下标在数据库中修改
                DB::table('config')
                ->where('conf_id',$v)
                ->update(['conf_content'=>$input['conf_content'][$k]]);
            }
            //提交事务
            DB::commit();
            //执行写配置文件
            $this->putContent();
            return redirect('admin/config')->with('msg','修改成功点击关闭');
        } catch (\Exception $e) {
            //回滚事务
            DB::rollBack();
            return redirect()->back()->with('msg',$e->getMessage());
        }
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $total = Config::count();
        //获取提交的请求参数
        $input = $request->all();
        $conf = Config::get();
        foreach ($conf as $v) {
            switch ($v->field_type) {
                //文本框input
                case 'input':
                    $v->conf_contents = '<input value="'.$v->conf_content.'" type="text" name="conf_content[]"  class="layui-input">';
                    break;
                
                //文本域
                case 'textarea':
                    $v->conf_contents = '<textarea name="conf_content[]" class="layui-textarea">'.$v->conf_content.'</textarea>';
                    break;

                //图片类型
                // <img src="" alt="" id="art_thumb_img" style="max-width: 350px; max-height:100px;">
                case 'image':
                    $v->conf_contents =<<<EOF
                        
                        <div class="">
                            <img src="{$v->conf_content}" alt="" id="art_thumb_img" style="max-width: 350px; max-height:100px;">
                            <input type="hidden" id="art_thumb" class="hidden" name="conf_content[]" value="{$v->conf_content}">
                            <button style="margin-left:90px;" type="button" class="layui-btn" id="test1">
                              <i class="layui-icon">&#xe67c;</i>修改图片</button>
                            <input type="file" name="photo" id="photo_upload" style="display: none;" />
                        </div>                     
EOF;
                    break;                

                //单选按钮radio
                case 'radio':
                    //定义一个字符串，存放最终的拼接结果
                    $str = '';
                    //以逗号分割1|开启,0|关闭
                    $arr = explode(',',$v->field_value) ;
                    foreach ($arr as $n){
                        //以|分割1|开启
                        $a = explode('|',$n);
                        if($a[0] == $v->conf_content){
                            $str.= '<input type="radio" checked name="conf_content[]" value="'.$a[0].'" title="'.$a[1].'">'.$a[1].'&nbsp;&nbsp;&nbsp;';
                        }else{
                            $str.= '<input type="radio"  name="conf_content[]" value="'.$a[0].'" title="'.$a[1].'">'.$a[1].'&nbsp;&nbsp;&nbsp;';
                        }
                    }
                    $v->conf_contents = $str;
                    break;             
            }
        }
        return view('admin.config.list',['conf'=>$conf,'total'=>$total]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.config.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //接收提交的参数
        $input = $request->except('_token');
        //添加到数据库中
        $res = Config::create($input);
        if($res){
            $this->putContent();
            return redirect('admin/config')->with('msg','添加成功,点击关闭');
        }else{
            return back()->with('msg','添加失败，点击关闭');
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $res = Config::find($id)->delete();
        if($res){
            $data = [
                'status'=>0,
                'msg'=>'删除成功'
            ];
        }else{
            $data = [
                'status'=>1,
                'msg'=>'删除失败'
            ];
        }
        return $data;
    }
}
