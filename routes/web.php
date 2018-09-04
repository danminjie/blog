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
Route::get('/code/captcha/{tmp}', 'Admin\LoginController@captcha');

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

Route::group(['prefix'=>'admin','namespace'=>'Admin','middleware'=>'islogin'],function(){
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
	//用户模块相关路由
	Route::resource('user','UserController');
});