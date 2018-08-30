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

// Route::get('/', function () {
//     return view('welcome');
// });

// //用户添加路由
// Route::get('user/add','UserController@add');

// //执行添加路由
// Route::post('user/insert','UserController@insert');
// //用户列表路由
// Route::get('user/index','UserController@index');
// Route::get('user/edit/{id}','UserController@edit');
// //执行修改路由
// Route::post('user/update','UserController@update');
// //用户删除路由
// Route::get('user/del/{id}','UserController@del');
//后台登录路由
Route::get('admin/login','Admin\LoginController@login');
//执行登录
Route::post('admin/do_login','Admin\LoginController@do_login');
//验证码路由
Route::get('admin/code','Admin\LoginController@code');
Route::get('/code/captcha/{tmp}', 'Admin\LoginController@captcha');

