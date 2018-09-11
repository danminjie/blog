<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>成功</title>
<style type="text/css">
*{ padding: 0; margin: 0; }
body{ background: #fff; font-family: '微软雅黑'; color: #CCC; font-size: 16px; }
.system-message{ padding: 24px 48px; margin:auto; border: #CCC 3px solid; top:50%; width:800px; border-radius:10px;
    -moz-border-radius:10px; /* Old Firefox */}
.system-message h1{ font-size: 100px; font-weight: normal; line-height: 120px; margin-bottom: 5px; }
.system-message .jump{ padding-top: 10px; color: #999;}
.system-message .success,.system-message .error{ line-height: 1.8em;  color: #999; font-size: 36px; font-family: '黑体'; }
.system-message .detail{ font-size: 12px; line-height: 20px; margin-top: 12px; display:none}
</style>
<!-- Bootstrap core CSS -->
<link href="//cdn.bootcss.com/bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
	<br /><br /><br />
<div class="system-message">
<present name="message">
<h1 class="glyphicon glyphicon-ok-circle" style="color:#09F"><p class="success">{{ $msg }}</p></h1>
<br />
<a href="index">跳转到首页</a> <a style="margin-left: 100px;" href="login">跳转到登录页</a>
</present>
<p class="detail"></p>
</div>
</body>
</html>