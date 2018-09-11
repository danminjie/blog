<!DOCTYPE html>
<html lang="zh-CN">
 <head> 
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
  <!-- 引入页面描述和关键字模板 --> 
  <title>登录</title> 
  <!-- 网站图标 --> 
  <link rel="shortcut icon" href="{{ asset('home/images/favicon.ico') }}" /> 
  <!-- 禁止浏览器初始缩放 --> 
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0" /> 
  <!-- 引入主题样式表 --> 
  <link rel="stylesheet" type="text/css" href="{{ asset('home/css/style.css') }}" /> 
  <!-- 引入主题响应式样式表--> 
  <link rel="stylesheet" type="text/css" href="{{ asset('home/css/responsive.css') }}" /> 
  <link rel="stylesheet" type="text/css" href="{{ asset('home/css/custom.css') }}" /> 
  <link rel="stylesheet" type="text/css" href="{{ asset('home/css/login.css') }}" /> 
  <!-- 引入字体样式表--> 
  <link rel="stylesheet" type="text/css" href="{{ asset('home/css/font-awesome.css') }}" media="all" /> 
  <link rel="stylesheet" href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="{{ asset('home/css/layui.css') }}" /> 
  <script type="text/javascript" src="{{ asset('home/js/jquery.min.js?ver=4.3.6') }}"></script> 
  <script type="text/javascript" src="{{ asset('home/js/layer.js') }}"></script> 
 </head> 
 <body id="wrap" class="search search-results">  
  <!-- Nav --> 
  <!-- Moblie nav--> 
  <header class="header-wrap" id="nav-scroll"> 
     <div class="nav-wrap"> 
      <div class="logo-title"> 
       <a href="{{ url('/') }}" alt="{{ config('webconfig.web_title') }}" title="{{ config('webconfig.web_title') }}"> {{ config('webconfig.web_title') }} </a> 
      </div> 
      <!-- Toggle menu --> 
      <div class="toggle-menu"> 
       <i class="fa fa-bars"></i> 
      </div>  
      <!-- /.Focus us --> 
      <!-- Menu Items Begin --> 
       
      <!-- Menu Items End --> 
     </div> 
     <div class="clr"></div> 
     <div class="site_loading"></div> 
    </header> 
    <div class="hidefixnav"></div> 
    <!-- End Nav --> 
    <script type="text/javascript">
      $('.site_loading').animate({'width':'33%'},50);  //第一个进度节点
    </script>
    <!-- Main Wrap --> 
    <div class="login_box">
      <div class="login_l_img"><img src="{{ asset('home/images/login-img.png') }}" /></div>
      <div class="login">
          <div class="login_logo"><a href="#"><img src="{{ asset('home/images/login_logo.png') }}" /></a></div>
          <div class="login_name">
               <p>用户登录中心</p>
              {{--判断是否添加错误的提示信息--}}
              @if(!empty(session('msg')))
              <div class="alert alert-danger" onclick="this.remove();">
              <ul>
                  <li>{{ session('msg') }}</li>
              </ul>       
              </div>  
              @endif  
              {{--判断是否添加错误的提示信息--}}
              @if(!empty(session('active')))
              <div class="alert alert-danger" onclick="this.remove();">
              <ul>
                  <li>{{ session('active') }}</li>
              </ul>       
              </div>  
              @endif                  
          </div>
          <form method="post" action="{{url('/dologin')}}" onSubmit="return confirm();">
              <input name="user_name" id="user_name" type="text" placeholder="请输入邮箱或者手机号">
              {{ csrf_field() }}
              <input name="user_pass" type="password" id="user_pass" placeholder="请输入密码" />
              <input value="登录" style="width:100%;" type="submit">
          
          <div style="line-height: 20px">
            <br>
            <input type="checkbox" name="remenber">记住账号?<a style="margin-left: 50px" href="{{ url('/phoneregister') }}">注册</a><a style="margin-left: 50px" href="{{ url('/forget') }}">忘记密码？</a>
          </div>          
      </div>
      </form>
</div>
<script>
    function confirm()
      {
      　　if($("#user_name").val() == '')
        {
      　　layer.msg('请输入手机号或者邮箱', {icon: 5});
      　　$("#user_name").focus();
      　　return false;
       }
       else if($("#user_pass").val().length == 0)
       {
       　　layer.msg('密码不能为空', {icon: 5});
       　　$("#user_pass").focus();
       　　return false;
       }
       else
       {
       　　return true;
       } 
    }  
</script>
 </body>
</html>