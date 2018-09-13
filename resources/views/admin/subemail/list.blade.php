<!DOCTYPE html>
<html>
  
  <head>
    <meta charset="UTF-8">
    <title>邮件订阅列表</title>
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
          <cite>邮件订阅列表</cite></a>
      </span>
      <a class="layui-btn layui-btn-small" style="line-height:1.6em;margin-top:3px;float:right" href="javascript:location.replace(location.href);" title="刷新">
        <i class="layui-icon" style="line-height:30px">ဂ</i></a>
    </div>
    <div class="x-body">
      <xblock>
        <button class="layui-btn layui-btn-danger" onclick="delAll()"><i class="layui-icon"></i>群发送邮件</button>
        <button class="layui-btn" onclick="location='{{ url('admin/permission/create') }}'"><i class="layui-icon"></i>添加</button>
        <span class="x-right" style="line-height:40px">共有数据：{{$total}} 条</span>
      </xblock>
      <table class="layui-table">
        <thead>
          <tr>
            <th>
              <div class="layui-unselect header layui-form-checkbox" lay-skin="primary"><i class="layui-icon">&#xe605;</i></div>
            </th>
            <th>ID</th>
            <th>邮箱</th>
            <th>状态</th>
            <th>操作</th></tr>
        </thead>
        <tbody>
          @foreach($email as $v)
          <tr>
            <td>
              <div class="layui-unselect layui-form-checkbox" lay-skin="primary" data-id='{{$v->email}}'><i class="layui-icon">&#xe605;</i></div>
            </td>
            <td>{{$v->id}}</td>
            <td>{{$v->email}}</td>
            <td>
              @if ($v->status == 0)
                <button class="btn layui-btn">正常</button>
              @else
                <button disabled class="btn layui-btn-danger">退订</button>
              @endif
            </td>
            <td class="td-manage">                     
              <a title="删除" onclick="member_del(this,'{{$v->id}}')" href="javascript:;">
                <i class="layui-icon">&#xe640;</i>
              </a>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
      <div class="page">
        {!! $email->render() !!}
      </div>

    </div>

    <script>
      layui.use('laydate', function(){
        var laydate = layui.laydate;
        
        //执行一个laydate实例
        laydate.render({
          elem: '#start' //指定元素
        });

        //执行一个laydate实例
        laydate.render({
          elem: '#end' //指定元素
        });
      });

       
      /*用户-删除*/
      function member_del(obj,id){
        layer.confirm('确认要删除吗？',function(index){
            //发异步删除数据
            $.get('/admin/subemail/del/'+id, function(data) {
              if(data.status == 0){
                $(obj).parents("tr").remove();
                layer.msg('删除成功!',{icon:6,time:1000});
              }else{
                layer.msg('删除失败!',{icon:5,time:1000});
              }
              
            });
        });          
      }

      function delAll (argument) {

        var ids = [];
        $(".layui-form-checked").not('.header').each(function(i,v){
          var u = $(v).attr('data-id');
          if(u == 1){
            return false;
          }
          ids.push(u);
        });
        if(ids == ''){
          layer.msg('请选择要发送邮件的用户',{icon:5});
          return false;
        }
        layer.prompt({title: '请输入要群发的内容', formType: 2}, function(text, index){
          layer.close(index);
            $.get('/admin/subemail/allemail', {ids: ids,text:text}, function(data) {
              // console.log(data);
              if(data.status == 0){
                layer.msg(data.msg, {icon: 6});               
              }else{
                layer.msg('群发失败', {icon: 5});
              }
            });
        });
      }
    </script>
    
  </body>

</html>