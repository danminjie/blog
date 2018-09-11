<!DOCTYPE html>
<html>
  
  <head>
    <meta charset="UTF-8">
    <title>用户列表页</title>
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
          <cite>用户列表</cite></a>
      </span>
      <a class="layui-btn layui-btn-small" style="line-height:1.6em;margin-top:3px;float:right" href="javascript:location.replace(location.href);" title="刷新">
        <i class="layui-icon" style="line-height:30px">ဂ</i></a>
    </div>
    <div class="x-body">
      <div class="layui-row">
        <form action="{{ url('admin/article') }}" method="get" class="layui-form layui-col-md12 x-so">
            <div class="layui-input-inline">
              <select name="num" lay-verify="required">
                <option value="3" @if($request->input('num') == 3) selected @endif>3</option>
                <option value="5" @if($request->input('num') == 5) selected @endif>5</option>
                <option value="8" @if($request->input('num') == 8) selected @endif>8</option>
              </select>
          </div>
          <input type="text" name="arti_title"  placeholder="请输入文章标题" autocomplete="off" value="{{$request->input('arti_title')}}" class="layui-input">
          <button class="layui-btn"  lay-submit="" lay-filter="sreach"><i class="layui-icon">&#xe615;</i></button>
        </form>
      </div>
      <xblock>
        <button class="layui-btn layui-btn-danger" onclick="delAll()"><i class="layui-icon"></i>批量删除</button>
        <button class="layui-btn" onclick="location='{{ url('admin/article/create') }}'"></i>添加文章</button>
        <span class="x-right" style="line-height:40px">共有数据：{{$total}} 条</span>
      </xblock>
      @if (count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
      @endif      
      <table class="layui-table">
        <thead>
          <tr>
            <th>
              <div class="layui-unselect header layui-form-checkbox" lay-skin="primary"><i class="layui-icon">&#xe605;</i></div>
            </th>
            <th>ID</th>
            <th>文章标题</th>
            <th>文章标签</th>
            <th>查看次数</th>
            <th>缩略图</th>
            <th>状态</th>
            <th>操作</th>
          </tr>
        </thead>
        <tbody>
          @foreach($article as $v)
          <tr>
            <td>
              <div class="layui-unselect layui-form-checkbox" lay-skin="primary" data-id='{{$v->art_id}}'><i class="layui-icon">&#xe605;</i></div>
            </td>
            <td>{{$v->art_id}}</td>
            <td>{{$v->art_title}}</td>
            <td>{{$v->art_tag}}</td>
            <td>{{$v->art_view}}</td>
            <td><img src="{{ url($v->art_thumb) }}" alt=""></td>
            <td class="td-status">
            @if($v['art_status'] == 1) <span class="layui-btn layui-btn-normal layui-btn-mini">已添加推荐位</span> @endif
            @if($v['art_status'] == 0) <span class="layui-btn layui-btn-normal layui-btn-mini layui-btn-disabled">未添加推荐位</span> @endif
              

            </td>
            <td class="td-manage">
              @if($v['art_status'] == 1)
              <a onclick="member_stop(this,'{{$v->art_id}}')" href="javascript:;"  title="取消推荐">
                <i class="layui-icon">&#xe601;</i>
              </a> @endif
              @if($v['art_status'] == 0)
              <a onclick="member_start(this,'{{$v->art_id}}')" href="javascript:;"  title="加入推荐">
                <i class="layui-icon">&#xe62f;</i>
              </a> @endif              
              <a title="编辑" onclick="x_admin_show('修改','{{ url('admin/article/'.$v->art_id.'/edit') }}',600,400)"  href="javascript:;">
                <i class="layui-icon">&#xe642;</i>
              </a>              
              {{-- <a onclick="x_admin_show('修改密码','member-password.html',600,400)" title="修改密码" href="javascript:;">
                <i class="layui-icon">&#xe631;</i>
              </a> --}}
              <a title="删除" onclick="member_del(this,'{{$v->art_id}}')" href="javascript:;">
                <i class="layui-icon">&#xe640;</i>
              </a>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
      <div class="page">
        {!! $article->appends($request->all())->render() !!}
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

       /*用户-停用*/
      function member_stop(obj,id){
          layer.confirm('确认要取消推荐位吗？',function(index){
            //发异步把用户状态进行更改
            $.get('/admin/article/stop/'+id, function(data) {
              if(data.status == 0){
                $(obj).attr('title','加入推荐')
                $(obj).attr('onclick','member_start(this,'+id+')');
                $(obj).find('i').html('&#xe62f;');
                $(obj).parents("tr").find(".td-status").find('span').addClass('layui-btn-disabled').html('已取消推荐位');
                layer.msg(data.message,{icon: 5,time:1000});                
              }else{
                layer.msg('取消推荐失败',{icon: 5,time:1000}); 
              }        
            });
            
          });
      }
      /*用户-启用*/
      function member_start(obj,id){
          layer.confirm('确认要加入推荐位吗？',function(index){
            //发异步把用户状态进行更改
            $.get('/admin/article/start/'+id, function(data) {
              if(data.status == 0){
                $(obj).attr('title','取消推荐');
                $(obj).attr('onclick','member_stop(this,'+id+')');
                $(obj).find('i').html('&#xe601;');
                $(obj).parents("tr").find(".td-status").find('span').html('已加入推荐位');
                $(obj).parents("tr").find(".td-status").find('span').attr('class','layui-btn layui-btn-normal layui-btn-mini');
                layer.msg(data.message,{icon: 6,time:1000});                
              }else{
                layer.msg('加入推荐失败',{icon: 5,time:1000});   
              }      
            });
            
          });
      }      
      /*用户-删除*/
      function member_del(obj,id){
        layer.confirm('确认要删除吗？',function(index){
            //发异步删除数据
            $.post('/admin/article/'+id, {"_method": "DELETE","_token":"{{csrf_token()}}"}, function(data) {
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
        layer.confirm('确认要删除吗？',function(index){
            $.get('/admin/user/del', {ids: ids}, function(data) {
              if(data.status == 0){
                layer.msg(data.message, {icon: 6});
                $(".layui-form-checked").not('.header').parents('tr').remove();                
              }else{
                layer.msg(data.message, {icon: 5});
              }
            });
            //捉到所有被选中的，发异步进行删除
        });
      }

    </script>
    
  </body>

</html>