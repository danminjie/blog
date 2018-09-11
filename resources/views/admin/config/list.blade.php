<!DOCTYPE html>
<html>
  
  <head>
    <meta charset="UTF-8">
    <title>网站配置列表页</title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
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
    <div class="x-nav">
      <span class="layui-breadcrumb">
        <a>
          <cite>配置列表</cite></a>
      </span>
      <a class="layui-btn layui-btn-small" style="line-height:1.6em;margin-top:3px;float:right" href="javascript:location.replace(location.href);" title="刷新">
        <i class="layui-icon" style="line-height:30px">ဂ</i></a>
    </div>
    <div class="x-body">
      <div class="layui-row">
      </div>
      <xblock>
        <button class="layui-btn layui-btn-danger" onclick="delAll()"><i class="layui-icon"></i>批量删除</button>
        <button class="layui-btn" onclick="location='{{ url('admin/config/create') }}'"></i>添加网站配置</button>
        <span class="x-right" style="line-height:40px">共有数据：{{$total}} 条</span>
      </xblock>   
      <form id="art_form" action="{{ url('admin/config/changecontent') }}" method="post">
      <table class="layui-table">
        <thead>
          <tr>
            {{--<th width="10px">--}}
              {{--<div class="layui-unselect header layui-form-checkbox" lay-skin="primary"><i class="layui-icon">&#xe605;</i></div>--}}
            {{--</th>--}}
            <th style="width:50px;">ID</th>
            <th style="width:100px;">标题</th>
            <th style="width:120px;">名称</th>
            <th style="width:700px;">内容</th>
            <th>操作</th></tr>
        </thead>
        <tbody>
        @foreach($conf as $v)
          <tr>
            <input type="hidden" value="{{ $v->conf_id }}" name="conf_id[]">
            <td>{{ $v->conf_id }}</td>
            <td>{{ $v->conf_title }}</td>
            <td>{{ $v->conf_name }}</td>
            <td>{!! $v->conf_contents !!}</td>
            <td class="td-manage">
              {{--<a title="编辑"  onclick="x_admin_show('编辑','{{ url('admin/cate/'.$v->cate_id.'/edit') }}',600,400)" href="javascript:;">--}}
                {{--<i class="layui-icon">&#xe642;</i>--}}
              {{--</a>--}}
              <a title="删除" onclick="member_del(this,{{ $v->conf_id }})" href="javascript:;">
                <i class="layui-icon">&#xe640;</i>
              </a>
            </td>
          </tr>
          @endforeach
        <tr>
          {{--判断是否添加错误的提示信息--}}
          @if(!empty(session('msg')))
          <div class="alert alert-danger" onclick="this.remove();">
          <ul>
              <li>{{ session('msg') }}</li>
          </ul>       
          </div>  
          @endif            
        </tr>
        <tr>
          <td colspan="6">
            {{ csrf_field() }}
            <button  class="layui-btn" lay-filter="add" lay-submit="">
              批量修改
            </button>
          </td>
        </tr>
        </tbody>
      </table>      
      </form>

    </div>
    <script>
      layui.use(['form','layer','laydate'], function(){
        var laydate = layui.laydate;
          var form = layui.form;
        
          $('#test1').on('click', function() {
            //自动触发点击事件
            $('#photo_upload').trigger('click');
            $('#photo_upload').on('change', function() {
              var obj = this;
              var formData = new FormData($('#art_form')[0]);
              $.ajax({
                url: '/admin/config/upload',
                type: 'post',
                data: formData,
                // 因为data值是FormData对象，不需要对数据做处理
                processData: false,
                contentType: false,
                success: function(data) {
                  if (data['ServerNo'] == '200') {
                    //默认服务器保存
                    $('#art_thumb_img').attr('src', '/uploads/config/' + data['ResultData']);
                    
                    //将隐藏域的值改变，提交到数据库
                    $('input[id=art_thumb]').val('/uploads/config/' + data['ResultData']);
                    $(obj).off('change');
                  } else {
                    // 如果失败
                    alert(data['ResultData']);
                  }
                },
                error: function(XMLHttpRequest, textStatus, errorThrown) {
                  var number = XMLHttpRequest.status;
                  var info = "错误号" + number + "文件上传失败!";
                  // 将菊花换成原图
                  // $('#pic').attr('src', '/file.png');
                  alert(info);
                },
                async: true
              });
            });
          });          

        //执行一个laydate实例
        laydate.render({
          elem: '#start' //指定元素
        });

        //执行一个laydate实例
        laydate.render({
          elem: '#end' //指定元素
        });

          //监听提交
          form.on('submit(add)', function(data){
              console.log(data);
          });
      });
      /*网站配置项-删除*/
      function member_del(obj,id){
          layer.confirm('确认要删除吗？',function(index){
              //发异步删除数据
              $.post('{{ url('admin/config/') }}/'+id,{'_method':'delete','_token':"{{csrf_token()}}"},function (data) {
                  if(data.status == 0){
                      $(obj).parents("tr").remove();
                      layer.msg(data.message,{icon:6,time:2000});
                  }else{
                      location.reload();
                      layer.msg('删除失败!',{icon:5,time:2000});
                  }
              })
          });
      }
    </script>
  </body>
</html>