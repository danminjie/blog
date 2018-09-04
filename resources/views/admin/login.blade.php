<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>但敏杰博客后台登录</title>
	<meta name="renderer" content="webkit|ie-comp|ie-stand">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,user-scalable=yes, minimum-scale=0.4, initial-scale=0.8,target-densitydpi=low-dpi" />
    <meta http-equiv="Cache-Control" content="no-siteapp" />
    <link rel="stylesheet" href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="shortcut icon" href="/favicon.ico" type="/adminimage/x-icon" />
    <link rel="stylesheet" href="{{ asset('admin/css/font.css') }}">
	  <link rel="stylesheet" href="{{ asset('admin/css/xadmin.css') }}">
    <script type="text/javascript" src="https://cdn.bootcss.com/jquery/3.2.1/jquery.min.js"></script>
    <script src="{{ asset('admin/lib/layui/layui.js') }}" charset="utf-8"></script>
    <script type="text/javascript" src="{{ asset('admin/js/xadmin.js') }}"></script>

</head>
<body class="login-bg">
    
    <div class="login">
        <div class="message">博客后台管理系统</div>
        <div id="darkbannerwrap">
          
        </div>
          @if (count($errors) > 0)
              <div class="alert alert-danger">
                  <ul>
                      @foreach ($errors->all() as $error)
                          <li>{{ $error }}</li>
                      @endforeach
                  </ul>
              </div>
          @endif        
        <form action="/admin/do_login" method="post" class="layui-form" >
         {{csrf_field()}}
            <input name="username" placeholder="用户名"  type="text" lay-verify="required" class="layui-input" >
            <hr class="hr15">
            <input name="password" lay-verify="required" placeholder="密码"  type="password" class="layui-input">
            <hr class="hr15">
            <input name="code" lay-verify="required" placeholder="验证码"  type="text" class="layui-input" style="height:40;width:60%;float: left"><img src="{{ URL('/code/captcha/1') }}" style="float: right" onclick="this.src='{{ URL('/code/captcha/1') }}}?rnd=' + Math.random();">           
            <hr class="hr15">
            <input value="登录" lay-submit lay-filter="login" style="width:100%;" type="submit">
            <hr class="hr20" >
        </form>
    </div>

    <script>
        // $(function  () {
        //     layui.use('form', function(){
        //       var form = layui.form;
        //       // layer.msg('请登录', function(){
        //       //   //关闭后的操作
        //       //   });
        //       //监听提交
        //       form.on('submit(login)', function(data){
        //         layer.msg(JSON.stringify(data.field),function(){
        //             $.post('/admin/do_login', {JSON.stringify(data.field)}, function(data, textStatus, xhr) {
        //               layer.msg(data,{icon:6});
        //             });
        //         });
        //         return false;
        //       });
        //     });
        // })   
    </script>
</body>
</html>