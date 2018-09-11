<!-- 网站图标 --> 
  <link rel="shortcut icon" href="{{ asset('home/images/favicon.ico') }}" /> 
  <!-- 禁止浏览器初始缩放 --> 
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0" /> 
  <!-- 引入主题样式表 --> 
  <link rel="stylesheet" type="text/css" href="{{ asset('home/css/style.css') }}" /> 
  <!-- 引入主题响应式样式表--> 
  <link rel="stylesheet" type="text/css" href="{{ asset('home/css/responsive.css') }}" /> 
  <link rel="stylesheet" type="text/css" href="{{ asset('home/css/custom.css') }}" /> 
  <!-- 引入字体样式表--> 
  <link rel="stylesheet" type="text/css" href="{{ asset('home/css/font-awesome.css') }}" media="all" /> 

  <style type="text/css">
    img.wp-smiley,
    img.emoji {
    	display: inline !important;
    	border: none !important;
    	box-shadow: none !important;
    	height: 1em !important;
    	width: 1em !important;
    	margin: 0 .07em !important;
    	vertical-align: -0.1em !important;
    	background: none !important;
    	padding: 0 !important;
    }
    .page{
      margin-top: 20px;
      text-align: center;

    }
    .page a{
      display: inline-block;
      background: #fff url() 0 0 no-repeat;
      color: #888;
      padding: 10px;
      min-width: 15px;
      border: 1px solid #E2E2E2;

    }
    .page span{
      display: inline-block;
      padding: 10px;
      min-width: 15px;
      border: 1px solid #E2E2E2;
    }
    .page span.current{
      display: inline-block;
      background: #009688 url() 0 0 no-repeat;
      color: #fff;
      padding: 10px;
      min-width: 15px;
      border: 1px solid #009688;
    }
    .page .pagination li{
      display: inline-block;
      margin-right: 5px;
      text-align: center;
    }
    .page .pagination li.active span{
      background: #009688 url() 0 0 no-repeat;
      color: #fff;
      border: 1px solid #009688;

    }

  </style> 