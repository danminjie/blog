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
    <link rel="stylesheet" href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
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
    <xblock>
        <button class="layui-btn layui-btn-danger" onclick="location='{{ url('admin/permission') }}';"><i class="layui-icon"></i>返回权限列表</button>
        
      </xblock>
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
                  <input type="text" id="L_email" name="per_name" required="" lay-verify=""
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
                    <input type="text" id="L_cate_name" name="per_url" required=""
                           autocomplete="off" class="layui-input" style="width:390px;">
                </div>

            </div>       
          
          
          <div class="layui-form-item">
              <label for="L_repass" class="layui-form-label">
              </label>
              <button  class="layui-btn" lay-filter="add" lay-submit="">
                  增加
              </button>
          </div>
      </form>
    </div>
    <script>
        layui.use(['form','layer'], function(){
            $ = layui.jquery;
          var form = layui.form
          ,layer = layui.layer;
        
          // //自定义验证规则
          // form.verify({
          //   nikename: function(value){
          //     if(value.length < 5){
          //       return '昵称至少得5个字符啊';
          //     }
          //   }
          //   ,pass: [/(.+){6,12}$/, '密码必须6到12位']
          //   ,repass: function(value){
          //       if($('#L_pass').val()!=$('#L_repass').val()){
          //           return '两次密码不一致';
          //       }
          //   }
          // });

          //监听提交
          form.on('submit(add)', function(data){
           
          //   //发异步，把数据提交给php
          //   $.ajax({
          //     url:'/admin/user',
          //     type:'POST',
          //     dataType:'json',
          //     headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
          //     data:data.field,
          //     success:function(res){
          //       // 弹层提示并刷新父页面
          //       if(res.status == 0){
          //         layer.alert(res.message,{icon:6},function(){
          //           parent.location.reload(true);
          //         })
          //       }else{
          //         layer.alert(res.message,{icon:6});
          //       }
          //     },
          //     erro:function(){

          //     }

          //   })
            // return false;
          });
        });
    </script>
  </body>

</html>