<!DOCTYPE html>
<html>
  
  <head>
    <meta charset="UTF-8">
    <title>欢迎页面-X-admin2.0</title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width,user-scalable=yes, minimum-scale=0.4, initial-scale=0.8,target-densitydpi=low-dpi" />
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" />
    <link rel="stylesheet" href="{{ asset('admin/css/font.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/css/xadmin.css') }}">
    <script type="text/javascript" src="https://cdn.bootcss.com/jquery/3.2.1/jquery.min.js"></script>
    <script type="text/javascript" src="{{ asset('admin/lib/layui/layui.js') }}" charset="utf-8"></script>
    <script type="text/javascript" src="{{ asset('admin/js/xadmin.js') }}"></script>
    <!-- 让IE8/9支持媒体查询，从而兼容栅格 -->
    <!--[if lt IE 9]>
      <script src="https://cdn.staticfile.org/html5shiv/r29/html5.min.js"></script>
      <script src="https://cdn.staticfile.org/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  
  <body>  
    <div class="x-body">
        <form class="layui-form" action="{{ url('admin/cate') }}" method="post">
            {{ csrf_field() }}
            @if ($res->cate_pid != 0)
            <div class="layui-form-item">
                <label for="L_email" class="layui-form-label">
                    <span class="x-red">*</span>父级分类
                </label>
                <div class="layui-input-inline">
                    <select name="cate_pid">
                        <option value="0">==顶级分类==</option>
                        @foreach($cate as $v)
                          @if ($v->cate_id == $res->cate_pid)
                            <option value="{{ $v->cate_id }}" selected = "selected">{{ $v->cate_name }}</option>
                          @else
                            <option value="{{ $v->cate_id }}">{{ $v->cate_name }}</option>
                          @endif
                        
                        @endforeach
                    </select>
                </div>
                <div class="layui-form-mid layui-word-aux">
                    <span class="x-red">*</span>
                </div>
            </div>
            @endif


            <input type="hidden" value="{{ $res->cate_id }}" name="cate_id">


            <div class="layui-form-item">
                <label for="L_username" class="layui-form-label">
                    <span class="x-red">*</span>分类名称
                </label>
                <div class="layui-input-inline">
                    <input type="text" id="L_username" name="cate_name" required=""
                           autocomplete="off" value="{{$res->cate_name}}" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <label for="L_catetitle" class="layui-form-label">
                    <span class="x-red">*</span>分类标题
                </label>
                <div class="layui-input-inline">
                    <input type="text" id="L_catetitle" name="cate_title" required=""
                           autocomplete="off" value="{{$res->cate_title}}" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <label for="L_cate_order" class="layui-form-label">
                    <span class="x-red">*</span>排序
                </label>
                <div class="layui-input-inline">
                    <input type="text" id="L_cate_order" name="cate_order" required=""
                           autocomplete="off" value="{{$res->cate_order}}" class="layui-input">

                </div>
            </div>
            <div class="layui-form-item">
                <label for="L_repass" class="layui-form-label">
                </label>
                <button  class="layui-btn" lay-filter="edit" lay-submit="">
                    修改
                </button>
            </div>
      </form>
    </div>
    <script>
    layui.use(['form','layer'], function(){
        $ = layui.jquery;
        var form = layui.form
            ,layer = layui.layer;
        //监听提交
        form.on('submit(edit)', function(data){
            var cateid = $("input[name='cate_id']").val();
            //console.log(uid);
            $.ajax({
                type: 'PUT',
                url: '/admin/cate/'+cateid,
                dataType: 'json',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                // data:JSON.stringify(data.field),
                data:data.field,
                success: function(data){

                    if(data.status == 0){
                        layer.alert("修改成功", {icon: 6},function () {
                            parent.location.reload();
                        });
                    }else{
                        layer.alert("修改失败", {icon: 5},function () {
                            parent.location.reload();
                        });
                    }

                },
                error:function(data) {
                    //console.log(1111111111111111);
                    // console.log(data.msg);
                },
            });
            return false;
        });


    });
    </script>
  </body>

</html>