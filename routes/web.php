<?php
// Authentication Routes...
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');
// Registration Routes...
Route::get('register', 'Auth\RegisterController@showRegistrationForm');
Route::post('register', 'Auth\RegisterController@register');

// Password Reset Routes...
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm');
Route::post('password/reset', 'Auth\ResetPasswordController@reset');
Route::get('/home', 'HomeController@index');
Route::group(['middleware' => 'auth'], function (){
    // 跳转新增博客页面
    Route::get('blog/add', 'BlogController@toAdd');
    // 新增博客
    Route::post('blog/add', 'BlogController@add');
    //
    Route::get('blog/list', 'BlogController@toList');
    //
    Route::get('blog/delete/{id}', 'BlogController@deteleById')->where('id', '[0-9]+');
    Route::get('blog/edit/{id}', 'BlogController@toEdit')->where('id', '[0-9]+');
    Route::post('blog/edit', 'BlogController@edit');
});
/**
 * 前台页面展示
 */
Route::get('/', 'WelcomeController@index');

Route::get('/type/{id}', 'WelcomeController@type');

Route::get('blog/view/{id}', 'BlogController@view')->where('id','[0-9]+');