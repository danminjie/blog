<!DOCTYPE html>
<html lang="zh-CN">
 <head> 
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
  <!-- 引入页面描述和关键字模板 --> 
  <title>注册</title> 
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
               <p>用户注册中心</p>                
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
          <form method="post" action="{{ url('/dophoneregister') }}" onSubmit="return confirm();">
          	{{ csrf_field() }}
              <input id="user_name" name="user_name" type="text"  value=""  placeholder="请输入手机号">
              <input id="user_pass" name="user_pass" type="password"  id="password" placeholder="密码" />
              <input id="yanzhengma" name="code" type="text"  placeholder="验证码" style="width:50%;" />
              <input type="button" id="fasong"  value="点击发送验证码" onclick="sendCode();" style="width:47%;margin-top: -15px;" />

              <input value="注册" style="width:100%;" type="submit">
          </form>
          <div>
          	<br>
          	<a href="{{ url('/forget') }}">忘记密码?</a><a style="margin-left: 150px" href="{{ url('/mailregister') }}">切换到邮箱注册</a>
          </div>
      </div>
</div>
<div style="text-align:center;"></div>
<script>
	//60秒倒计时
	var countdown = 60;
	function settime(){
		if(countdown == 0){
			$('#fasong').attr('onclick','sendCode();');
			$('#fasong').val('点击发送验证码');
			countdown = 60;
		}else{
			$('#fasong').removeAttr('onclick','sendCode();');
			$('#fasong').val('重新发送('+countdown+'s)');
			countdown --;
			setTimeout(function(){
				settime();
			},1000);
		}
	}
	function sendCode(){
		// alert(666);
		//1.获取手机号
		phone = $('input[name=user_name]').val();
		//2.判断手机号是否为空
		if(phone == ''){
			layer.msg('请输入手机号',{icon:5});
			return false;
		}
		if(phone.length != 11){
			layer.msg('手机号格式不正确',{icon:5});
			return false;
		}
		//检测手机号是否存在
		$.get('exists',{'user_name':phone},function(data){
            if(data.status == 0){
                layer.msg('账号已被注册',{'time':3000,'icon':5});
                $('#user_name').focus();
                return false;
            }else{
				settime();
				//3.ajax请求验证码，根据是否成功给提示信息
				$.get('sendsms',{'phone':phone},function(data){
		            if(data.msg == 'OK'){
		                layer.msg('发送成功,请注意查收',{'time':3000,'icon':6})
		            }else{
		                layer.msg(data.msg,{'time':3000,'icon':5})
		            }
		        });            	
	        }
	    });		
		
	}
	function confirm()
      {
      　　if($("#user_name").val() == '' || $("#user_name").val().length == 0)
      {
      　　layer.msg('请输入手机号', {icon: 5});
      　　$("#user_name").focus();
      　　return false;
     }
     else if($("#user_pass").val().length == 0)
     {
     　　layer.msg('密码不能为空', {icon: 5});
     　　$("#user_pass").focus();
     　　return false;
     }
     else if($("#yanzhengma").val() == '')
     {
     　　layer.msg('请输入验证码', {icon: 5});
     　　$("#yanzhengma").focus();
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