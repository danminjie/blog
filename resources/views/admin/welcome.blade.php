<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>欢迎页面-X-admin2.0</title>
        <meta name="renderer" content="webkit">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="viewport" content="width=device-width,user-scalable=yes, minimum-scale=0.4, initial-scale=0.8,target-densitydpi=low-dpi" />
        <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" />
        <link rel="stylesheet" href="{{ asset('admin/css/font.css') }}">
        <link rel="stylesheet" href="{{ asset('admin/css/xadmin.css') }}">
    </head>
    <body>
        <div class="x-body">
            <blockquote class="layui-elem-quote">亲爱的管理员<a style="color:red"> {{$log->user_name}} </a>欢迎来到后台系统，上次登录时间：{{ date('Y年m月d日 H:i:s',$log->logintime) }}</blockquote>
            <fieldset class="layui-elem-field">
              <legend>信息统计</legend>
              <div class="layui-field-box">
                <table class="layui-table" lay-even>
                    <thead>
                        <tr>
                            <th>前台会员</th>
                            <th>文章数量</th>
                            <th>管理员</th>
                            <th>权限</th>
                            <th>角色</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{$usertotal}}</td>
                            <td>{{$arttotal}}</td>
                            <td>{{$admintotal}}</td>
                            <td>{{$permission}}</td>
                            <td>{{$role}}</td>
                        </tr>
                    </tbody>
                </table>
                <table class="layui-table">
                <thead>
                    <tr>
                        <th colspan="2" scope="col">服务器信息</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th width="30%">服务器计算机名</th>
                        <td><span id="lbServerName">{{$_SERVER["SERVER_SOFTWARE"]}}</span></td>
                    </tr>
                    <tr>
                        <td>服务器IP地址</td>
                        <td>{{$_SERVER['SERVER_ADDR']}}</td>
                    </tr>
                    <tr>
                        <td>服务器域名</td>
                        <td>{{url('')}}</td>
                    </tr>
                    <tr>
                        <td>获取PHP安装路径 </td>
                        <td>{{DEFAULT_INCLUDE_PATH}}</td>
                    </tr>
                    <tr>
                        <td>PHP运行方式 </td>
                        <td>{{php_sapi_name()}}</td>
                    </tr>
                    <tr>
                        <td>最大上传限制 </td>
                        <td>{{get_cfg_var ("upload_max_filesize")}}</td>
                    </tr>
                    <tr>
                        <td>最大执行时间 </td>
                        <td>{{get_cfg_var("max_execution_time")."秒 "}}</td>
                    </tr>
                    <tr>
                        <td>脚本运行占用最大内存 </td>
                        <td>{{get_cfg_var ("memory_limit")}}</td>
                    </tr>
                    <tr>
                        <td>获取服务器系统目录 </td>
                        <td>{{$_SERVER['SystemRoot']}}</td>
                    </tr>
                    <tr>
                        <td>获取服务器语言 </td>
                        <td>{{$_SERVER['HTTP_ACCEPT_LANGUAGE']}}</td>
                    </tr>
                </tbody>
            </table>
              </div>
            </fieldset>
        </div>
    </body>
</html>