<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//前台路由组
Route::get('/','Home\IndexController@index');
//首页
Route::get('/index','Home\IndexController@index');
//列表页
Route::get('/list/{id}','Home\IndexController@list');
//详情页
Route::get('/detail/{id}','Home\IndexController@detail');
//评论
Route::post('/dodetmsg','Home\IndexController@dodetmsg');

//留言
Route::get('/message','Home\MessageController@message');
//处理留言
Route::post('/domessage','Home\MessageController@domessage');
//留言回复
Route::post('/messagehuifu','Home\MessageController@messagehuifu');
//收藏
Route::post('/collect','Home\IndexController@collect');


//前台登录
Route::get('/login','Home\LoginController@login');
Route::post('/dologin','Home\LoginController@dologin');
Route::get('/logout','Home\LoginController@logout');

//手机注册
Route::get('/phoneregister','Home\LoginController@phoneregister');
Route::post('/dophoneregister','Home\LoginController@dophoneregister');
//检测账号是否存在
Route::get('/exists','Home\LoginController@exists');

//邮箱注册
	Route::get('/mailregister','Home\LoginController@mailregister');
	Route::post('/domailregister','Home\LoginController@domailregister');
//激活账号
	Route::get('/active','Home\LoginController@active');
//找回密码
	Route::get('/forget','Home\LoginController@forget');
	//邮箱找回
	Route::get('/mailforget','Home\LoginController@mailforget');
	Route::post('/domailforget','Home\LoginController@domailforget');
	Route::get('/reset','Home\LoginController@reset');
	Route::post('/doreset','Home\LoginController@doreset');

	//手机找回
	Route::get('/phoneforget','Home\LoginController@phoneforget');
	Route::post('/dophoneforget','Home\LoginController@dophoneforget');
//搜索
	Route::get('/serach','Home\SerachController@serach');
//邮件订阅
	Route::get('/subscribe','Home\SerachController@subscribe');

//发送短信短信
Route::get('/sendsms','Home\LoginController@sendsms');
//验证码路由
Route::get('/code/captcha/{tmp}', 'Admin\LoginController@captcha');

//后台登录路由组
Route::group(['prefix'=>'admin','namespace'=>'Admin'],function(){
	//后台登录路由
	Route::get('login','LoginController@login');
	//执行登录
	Route::post('do_login','LoginController@do_login');
	//验证码路由
	Route::get('code','LoginController@code');
	//加密算法
	Route::get('jiami','LoginController@jiami');
});

Route::get('noaccess','Admin\LoginController@noaccess');

//后台路由组
Route::group(['prefix'=>'admin','namespace'=>'Admin','middleware'=>['islogin','hasRole']],function(){
	//后台首页
	Route::get('index','LoginController@index');
	//后台欢迎页
	Route::get('welcome','LoginController@welcome');
	//后台退出
	Route::get('logout','LoginController@logout');

	//批量删除
	Route::get('user/del','UserController@delAll');

	//用户启用，停用
	Route::get('user/stop/{id}','UserController@stop');
	Route::get('user/start/{id}','UserController@start');
	//用户角色管理
	Route::get('user/auth/{id}','UserController@auth');
	//执行用户角色处理
	Route::post('user/doauth','UserController@doauth');	
	//用户模块相关路由
	Route::resource('user','UserController');

	//角色授权
	Route::get('role/auth/{id}','RoleController@auth');
	//处理授权
	Route::post('role/doauth','RoleController@doauth');
	//角色模块
	Route::resource('role','RoleController');

	//权限模块资源路由
	Route::resource('permission','PermissionController');

	//分类模块资源路由
	Route::resource('cate','CateController');
	Route::post('cate/changeorder','CateController@changeorder');

	//文章模块资源路由

	//将markdown语法的内容转化为html语法的内容
    Route::post('article/pre_mk','ArticleController@pre_mk');
	//文件上传路由
	Route::post('article/upload','ArticleController@upload');
	//文章推荐、取消推荐
	Route::get('article/stop/{id}','ArticleController@stop');
	Route::get('article/start/{id}','ArticleController@start');	
	Route::resource('article','ArticleController');

	//网站配置模块路由
	//文件上传路由
	Route::post('config/upload','ConfigController@upload');	
	//修改配置内容路由
	Route::post('config/changecontent','ConfigController@changeContent');
	//写入配置文件路由
    Route::get('config/putcontent','ConfigController@putContent');
	Route::resource('config','ConfigController');

	//友情链接资源路由
	//批量删除
	Route::get('link/del','LinkController@delAll');	
	Route::resource('link','LinkController');

	//邮件订阅
	Route::get('subemail/index','SubemailController@index');
	//删除邮件订阅	
	Route::get('subemail/del/{id}','SubemailController@del');
	Route::get('subemail/allemail','SubemailController@allemail');

});