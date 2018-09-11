<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Link;

class LinkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $total = Link::count();
        //获取提交的请求参数
        $links = Link::orderBy('link_order','asc')
            ->paginate(8);
        return view('admin.link.list',['links'=>$links,'total'=>$total]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.link.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $input = $request->except('_token');
        //添加到数据库
        $res = Link::create($input);
        if ($res) {
            return redirect('admin/link')->with('msg','添加成功');
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
        //
        $link = Link::find($id);
        return view('admin.link.edit',['link'=>$link]);
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
        //根据id,获取要修改的用户
        $link = Link::find($id);
        //将用户的相关属性修改为用户提交的值
        $input = $request->except('_token');

        $res = $link->update($input);

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
        $link = Link::find($id);
        $res = $link->delete();
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
    }

    //批量删除u
    public function delAll(Request $request)
    {
        $input = $request->input('ids');
        $res = Link::destroy($input);
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
    }    
}
