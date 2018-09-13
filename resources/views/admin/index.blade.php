<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>但敏杰博客后台V 1.0</title>
	<meta name="renderer" content="webkit|ie-comp|ie-stand">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,user-scalable=yes, minimum-scale=0.4, initial-scale=0.8,target-densitydpi=low-dpi" />
    <meta http-equiv="Cache-Control" content="no-siteapp" />

    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" />
    <link rel="stylesheet" href="{{ asset('admin/css/font.css') }}">
	<link rel="stylesheet" href="{{ asset('admin/css/xadmin.css') }}">
    <script type="text/javascript" src="https://cdn.bootcss.com/jquery/3.2.1/jquery.min.js"></script>
    <script src="{{ asset('admin/lib/layui/layui.js') }}" charset="utf-8"></script>
    <script type="text/javascript" src="{{ asset('admin/js/xadmin.js') }}"></script>

</head>
<body>
    <!-- 顶部开始 -->
    <div class="container">
        <div class="logo"><a href="./index.html">但敏杰博客后台 V 1.0</a></div>
        <div class="left_open">
            <i title="展开左侧栏" class="iconfont">&#xe699;</i>
        </div>
        <ul class="layui-nav right" lay-filter="">
          <li class="layui-nav-item">
            <a href="javascript:;">{{session()->get('user')->user_name}}</a>
            <dl class="layui-nav-child"> <!-- 二级菜单 -->
              <dd><a href="{{ url('admin/logout') }}">退出</a></dd>
            </dl>
          </li>
          <li class="layui-nav-item to-index"><a href="/">前台首页</a></li>
        </ul>
        
    </div>
    <!-- 顶部结束 -->
    <!-- 中部开始 -->
     <!-- 左侧菜单开始 -->
    <div class="left-nav">
      <div id="side-nav">
        <ul id="nav">
            <li>
                <a href="javascript:;">
                    <i class="iconfont">&#xe6b8;</i>
                    <cite>会员管理</cite>
                    <i class="iconfont nav_right">&#xe697;</i>
                </a>
                <ul class="sub-menu">
                    <li>
                        <a _href="{{ url('admin/user') }}">
                            <i class="iconfont">&#xe6a7;</i>
                            <cite>会员列表</cite>
                            
                        </a>
                    </li >
                    <li>
                        <a _href="{{ url('admin/user/create') }}">
                            <i class="iconfont">&#xe6a7;</i>
                            <cite>添加会员</cite>
                            
                        </a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="javascript:;">
                    <i class="iconfont">&#xe726;</i>
                    <cite>角色管理</cite>
                    <i class="iconfont nav_right">&#xe697;</i>
                </a>
                <ul class="sub-menu">
                    <li>
                        <a _href="{{ url('admin/role') }}">
                            <i class="iconfont">&#xe6a7;</i>
                            <cite>角色列表</cite>
                        </a>
                    </li >
                    <li>
                        <a _href="{{ url('admin/role/create') }}">
                            <i class="iconfont">&#xe6a7;</i>
                            <cite>添加角色</cite>
                        </a>
                    </li >                    
                </ul>
            </li>
            <li>
                <a href="javascript:;">
                    <i class="iconfont">&#xe6a9;</i>
                    <cite>权限管理</cite>
                    <i class="iconfont nav_right">&#xe697;</i>
                </a>
                <ul class="sub-menu">
                    <li>
                        <a _href="{{ url('admin/permission') }}">
                            <i class="iconfont">&#xe6a7;</i>
                            <cite>权限列表</cite>
                        </a>
                    </li >
                    <li>
                        <a _href="{{ url('admin/permission/create') }}">
                            <i class="iconfont">&#xe6a7;</i>
                            <cite>添加权限</cite>
                        </a>
                    </li >
                </ul>
            </li>
            <li>
                <a href="javascript:;">
                    <i class="iconfont">&#xe723;</i>
                    <cite>分类管理</cite>
                    <i class="iconfont nav_right">&#xe697;</i>
                </a>
                <ul class="sub-menu">
                    <li>
                        <a _href="{{ url('admin/cate/create') }}">
                            <i class="iconfont">&#xe6a7;</i>
                            <cite>添加分类</cite>
                        </a>
                    </li >
                    <li>
                        <a _href="{{ url('admin/cate') }}">
                            <i class="iconfont">&#xe6a7;</i>
                            <cite>分类列表</cite>
                        </a>
                    </li >
                </ul>
            </li>
            <li>
                <a href="javascript:;">
                    <i class="iconfont">&#xe6a8;</i>
                    <cite>文章管理</cite>
                    <i class="iconfont nav_right">&#xe697;</i>
                </a>
                <ul class="sub-menu">
                    <li>
                        <a _href="{{ url('admin/article/create') }}">
                            <i class="iconfont">&#xe6a7;</i>
                            <cite>添加文章</cite>
                        </a>
                    </li >
                    <li>
                        <a _href="{{ url('admin/article') }}">
                            <i class="iconfont">&#xe6a7;</i>
                            <cite>文章列表</cite>
                        </a>
                    </li >
                </ul>
            </li>
            <li>
                <a href="javascript:;">
                    <i class="iconfont">&#xe713;</i>
                    <cite>网站配置</cite>
                    <i class="iconfont nav_right">&#xe697;</i>
                </a>
                <ul class="sub-menu">
                    <li>
                        <a _href="{{ url('admin/config/create') }}">
                            <i class="iconfont">&#xe6a7;</i>
                            <cite>添加配置</cite>
                        </a>
                    </li >
                    <li>
                        <a _href="{{ url('admin/config') }}">
                            <i class="iconfont">&#xe6a7;</i>
                            <cite>配置列表</cite>
                        </a>
                    </li >
                </ul>
            </li>
            <li>
                <a href="javascript:;">
                    <i class="iconfont">&#xe6b3;</i>
                    <cite>友情链接</cite>
                    <i class="iconfont nav_right">&#xe697;</i>
                </a>
                <ul class="sub-menu">
                    <li>
                        <a _href="{{ url('admin/link/create') }}">
                            <i class="iconfont">&#xe6a7;</i>
                            <cite>添加链接</cite>
                        </a>
                    </li >
                    <li>
                        <a _href="{{ url('admin/link') }}">
                            <i class="iconfont">&#xe6a7;</i>
                            <cite>链接列表</cite>
                        </a>
                    </li >
                </ul>
            </li>                                                         
            <li>
                <a href="javascript:;">
                    <i class="iconfont">&#xe6ce;</i>
                    <cite>订阅管理</cite>
                    <i class="iconfont nav_right">&#xe697;</i>
                </a>
                <ul class="sub-menu">
                    <li>
                        <a _href="{{url('admin/subemail/index')}}">
                            <i class="iconfont">&#xe6a7;</i>
                            <cite>订阅列表</cite>
                        </a>
                    </li >
                </ul>
            </li>
        </ul>
      </div>
    </div>
    <!-- <div class="x-slide_left"></div> -->
    <!-- 左侧菜单结束 -->
    <!-- 右侧主体开始 -->
    <div class="page-content">
        <div class="layui-tab tab" lay-filter="xbs_tab" lay-allowclose="false">
          <ul class="layui-tab-title">
            <li>我的桌面</li>
          </ul>
          <div class="layui-tab-content">
            <div class="layui-tab-item layui-show">
                <iframe src='{{ url('/admin/welcome') }}' frameborder="0" scrolling="yes" class="x-iframe"></iframe>
            </div>
          </div>
        </div>
    </div>
    <div class="page-content-bg"></div>
    <!-- 右侧主体结束 -->
    <!-- 中部结束 -->
    <!-- 底部开始 -->
    <div class="footer">
        <div class="copyright">博客系统 V 1.0 © 2015 - 2018 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a target="_blank" rel="nofollow" href="http://www.miibeian.gov.cn/" style="display:inline-block;text-decoration:none;height:20px;line-height:20px;"><img src="/home/images/beiantubiao.png" style="float:left;" />蜀ICP备17005368号-1</a></div>  
    </div>
    <!-- 底部结束 -->
    <script>
    //百度统计可去掉
    var _hmt = _hmt || [];
    (function() {
      var hm = document.createElement("script");
      hm.src = "https://hm.baidu.com/hm.js?b393d153aeb26b46e9431fabaf0f6190";
      var s = document.getElementsByTagName("script")[0]; 
      s.parentNode.insertBefore(hm, s);
    })();
    </script>
</body>
</html>