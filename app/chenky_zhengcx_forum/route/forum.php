<?php

use think\facade\Route;

// 静态地址：
// Index：首页，dopost，dores（无参数绑定）
// User：login,dologin,reg,doreg,me,upme,dochange,logout
Route::rule('/$','Index/index');
Route::rule('/dopost$','Index/dopost');
Route::rule('/login$','User/login');
Route::rule('/dologin$','User/dologin');
Route::rule('/reg$','User/reg');
Route::rule('/doreg$','User/doreg');
Route::rule('/me$','User/me');
Route::rule('/upme$','User/upme');
Route::rule('/dochange$','User/doChange');
Route::rule('/logout$','User/logout');

// 静态+动态（可选）地址：
// Index：板块页面view、post
Route::get('/list/<sid?>','index/view');
Route::get('/post/<sid?>','Index/post');
// 静态+动态（必选）变量：
// Index:detail详情页,dores(有参数绑定)
Route::get('info/<mid>$','index/detail');
Route::get('response/<mid>$','index/dores');

//Test控制器的路由
Route::rule('app','test/useapp');
Route::rule('log','test/writelog');


// miss路由：自动开启强制路由模式
Route::miss('Error/miss');