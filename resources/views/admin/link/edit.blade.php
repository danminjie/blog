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
    <div class="x-body">
      <form class="layui-form" id="art_form" action="{{ url('admin/link') }}" method="put">
        {{ csrf_field() }}
        <div class="layui-form-item">
                <label for="L_conf_title" class="layui-form-label">
                    <span class="x-red">*</span>链接名
                </label>
                <div class="layui-input-inline">
                    <input type="text" id="L_conf_title" value="{{$link->link_name}}" name="link_name" required="" autocomplete="off" class="layui-input" style="width:380px;">
                </div>
            </div>
            <div class="layui-form-item">
                <label for="L_conf_name" class="layui-form-label">
                    <span class="x-red">*</span>链接描述
                </label>
                <div class="layui-input-inline">
                    <input type="text" id="L_conf_name" value="{{$link->link_title}}" name="link_title" required=""
                           autocomplete="off" class="layui-input" style="width:380px;">
                </div>
            </div>
            <input type="hidden" name="link_id" value="{{ $link->link_id }}">
            <div class="layui-form-item">
                <label for="L_conf_content" class="layui-form-label">
                    <span class="x-red">*</span>链接地址
                </label>
                <div class="layui-input-inline">
                    <input type="text" id="L_conf_content" value="{{$link->link_url}}" name="link_url" required=""
                           autocomplete="off" class="layui-input" style="width:380px;">
                </div>
            </div>
            <div class="layui-form-item">
                <label for="L_conf_order" class="layui-form-label">
                    <span class="x-red">*</span>排序
                </label>
                <div class="layui-input-inline">
                    <input type="text" id="L_conf_order" value="{{$link->link_order}}" name="link_order" required=""
                           autocomplete="off" class="layui-input" >
                    {{ csrf_field() }}
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
</body>
    <script>
        layui.use(['form','layer'], function(){
            $ = layui.jquery;
          var form = layui.form
          ,layer = layui.layer;

          //监听提交
          form.on('submit(edit)', function(data){
            //获取 要修改的用户的ID
            var rid = $("input[name='link_id']").val();
            $.ajax({
                type : "PUT", //提交方式
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url : '/admin/link/'+rid,//路径
                data : data.field,//数据，这里使用的是Json格式进行传输
                dataType : "Json",
                success : function(result) {//返回数据根据结果进行相应的处理
                    // console.log(result);
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