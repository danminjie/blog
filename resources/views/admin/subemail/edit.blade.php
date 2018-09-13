<!DOCTYPE html>
<html>
  
  <head>
    <meta charset="UTF-8">
    <title>修改</title>
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
    {{--判断是否添加错误的提示信息--}}
        @if(!empty(session('msg')))
        <div class="alert alert-danger">
        <ul>
            <li>{{ session('msg') }}</li>
        </ul>       
        </div>  
        @endif            
    <div class="x-body">
        <form class="layui-form" action="{{ url('admin/permission') }}" method="post">
          {{csrf_field()}}
          <div class="layui-form-item">
              <label for="L_email" class="layui-form-label">
                  <span class="x-red">*</span>权限名
              </label>
              <div class="layui-input-inline">
                  <input type="text" id="L_email" value="{{$res->per_name}}" name="per_name" required="" lay-verify=""
                  autocomplete="off" class="layui-input">
              </div>
              <div class="layui-form-mid layui-word-aux">
                  <span class="x-red">*</span>
              </div>
          </div>
          <div class="layui-form-item">
                <label for="L_cate_name" class="layui-form-label">
                    <span class="x-red">*</span>对应控制路由
                </label>
                <div class="layui-input-inline">
                    <input type="text" id="L_cate_name" value="{{$res->per_url}}" name="per_url" required=""
                           autocomplete="off" class="layui-input" style="width:390px;">
                </div>
            <input type="hidden" name="id" value="{{ $res->id }}">
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
                //获取 要修改的用户的ID
                var rid = $("input[name='id']").val();
                $.ajax({
                    type : "PUT", //提交方式
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url : '/admin/permission/'+rid,//路径
                    data : data.field,//数据，这里使用的是Json格式进行传输
                    dataType : "Json",
                    success : function(result) {//返回数据根据结果进行相应的处理
                        console.log(result);
                        // 如果ajax的返回数据对象的status属性值是0，表示用户添加成功；弹添加成功的提示信息
                        if(result.status == 0){
                            layer.alert(result.msg, {icon: 6},function () {
                                //刷新父页面
                                parent.location.reload();
                            });
                        }else{
                            layer.alert(result.msg, {icon: 6},function () {
                                parent.location.reload();
                            });
                        }
                    }
                });
                return false;
            });
          
          
        });
    </script>
  </body>

</html>