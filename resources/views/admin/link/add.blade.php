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
    <![endif]--></head>
  
  <body>
    <xblock>
      <button class="layui-btn" onclick="location='{{ url('admin/link') }}'"></i>返回列表</button>
    </xblock>    
    <div class="x-body">
      <form class="layui-form" id="art_form" action="{{ url('admin/link') }}" method="post">
        {{ csrf_field() }}
        <div class="layui-form-item">
                <label for="L_conf_title" class="layui-form-label">
                    <span class="x-red">*</span>链接名
                </label>
                <div class="layui-input-inline">
                    <input type="text" id="L_conf_title" name="link_name" required="" autocomplete="off" class="layui-input" style="width:380px;">
                </div>
            </div>
            <div class="layui-form-item">
                <label for="L_conf_name" class="layui-form-label">
                    <span class="x-red">*</span>链接描述
                </label>
                <div class="layui-input-inline">
                    <input type="text" id="L_conf_name" name="link_title" required=""
                           autocomplete="off" class="layui-input" style="width:380px;">
                </div>
            </div>
            <div class="layui-form-item">
                <label for="L_conf_content" class="layui-form-label">
                    <span class="x-red">*</span>链接地址
                </label>
                <div class="layui-input-inline">
                    <input type="text" id="L_conf_content" value="http://" name="link_url" required=""
                           autocomplete="off" class="layui-input" style="width:380px;">
                </div>
            </div>
            <div class="layui-form-item">
                <label for="L_conf_order" class="layui-form-label">
                    <span class="x-red">*</span>排序
                </label>
                <div class="layui-input-inline">
                    <input type="text" id="L_conf_order" name="link_order" required=""
                           autocomplete="off" class="layui-input" >
                    {{ csrf_field() }}
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
</body>
    <script>
        layui.use(['form','layer'], function(){
            $ = layui.jquery;
          var form = layui.form
          ,layer = layui.layer;

          //监听提交
          form.on('submit(add)', function(data){

          });
        });
    </script>
  </body>

</html>