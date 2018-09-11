<?php

namespace App\Http\Controllers\Admin;

use App\Model\Cate;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //获取分类数据
        // $cates = Cate::get();
        $Tree = new Cate;
        $cates = $Tree->Tree();
        //统计分类
        $total = Cate::count();
        return view('admin.cate.list',['cates'=>$cates,'total'=>$total]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //获取一级类
        $cate = Cate::where('cate_pid',0)->get();
        return view('admin.cate.add',['cate'=>$cate]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //接受添加的分类数据
        $input = $request->except('_token');
        //添加到数据库
        $res = Cate::create($input);
        if ($res) {
            return redirect('admin/cate')->with('msg','添加成功');
        }else{
            return back()->with('msg','添加失败');
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
        $cate = Cate::where('cate_pid',0)->get();
        $res = Cate::find($id);
        return view('admin.cate.edit',['cate'=>$cate,'res'=>$res]);
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

        //根据id,获取要修改的用户
        $cate = Cate::find($id);
        //将用户的相关属性修改为用户提交的值
        $input = $request->all();

        $res = $cate->update($input);

        if($res){
            $data = [
                'status'=>0,
                'msg'=>'修改成功'
            ];
        }else{
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
        //删除分类
        if (!empty($id)) {
            //如果是顶级， 那么先删除顶级下面的子级
            \DB::table('category')->where('cate_pid',$id)->delete();
            $res = Cate::find($id)->delete();
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
        }else{
            $data = [
                'status'=>0,
                'msg'=>'没有ID可删，请检查'
            ];
        }
        return $data;        
    }

    //改变排序
    public function changeorder(Request $request)
    {
        $input = $request->except('_token');
        //2. 通过分类id获取当前分类
        $cate = Cate::find($input['cate_id']);
        //3. 修改当前分类的排序值
        $res = $cate->update(['cate_order'=>$input['cate_order']]);

        if($res){
            $data = [
                'status'=>0,
                'msg'=>'排序成功3秒后重置'
            ];
        }else{
            $data = [
                'status'=>1,
                'msg'=>'排序失败'
            ];
        }

        return $data;
    }
}
