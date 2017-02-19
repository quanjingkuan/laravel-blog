<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/
Route::group(['middleware' => ['web']], function () {
    Route::get('/','View\Home\IndexController@index');
    Route::get('/cate/{cate_id}','View\Home\IndexController@cate');
    Route::get('/a/{art_id}','View\Home\IndexController@item');
});


Route::group(['middleware' => ['web']], function () {

    Route::get('admin/login','View\Admin\LoginController@toLogin');
    Route::post('admin/login','Service\ValidataController@validata_admin_login');

});

Route::group(['middleware' => ['web','admin.login'],'prefix'=>'admin'], function () {
    //人性入口
    Route::get('/','View\Admin\IndexController@toIndex');
    //首页展示
    Route::get('index','View\Admin\IndexController@toIndex');
    //信息页
    Route::get('info','View\Admin\IndexController@toInfo');
    //退出登陆
    Route::get('logout','Service\Admin\IndexController@logout');
    //密码页
    Route::get('pass','View\Admin\IndexController@toPass');
    //修改密码
    Route::post('pass','Service\Admin\IndexController@updata');
    //uploadimg
    Route::any('upload','Service\Admin\BasicController@uploadImg');

    //异步排序分类
    Route::post('cate/changeorder','Service\Admin\CategroyController@changeOrder');
    //异步排序友情链接
    Route::post('link/changeorder','Service\Admin\LinksController@changeOrder');
    //异步排序导航
    Route::post('nav/changeorder','Service\Admin\NavsController@changeOrder');
    Route::post('conf/changeorder','Service\Admin\ConfigController@changeOrder');
    Route::post('conf/changecontent','Service\Admin\ConfigController@changeContent');
    Route::get('conf/putfield','Service\Admin\ConfigController@putField');

    //分类资源路由
    Route::resource('category','Service\Admin\CategroyController');
    //文章资源路由
    Route::resource('article','Service\Admin\ArticleController');
    //友情链接资源路由
    Route::resource('links','Service\Admin\LinksController');
    //自定义导航资源路由
    Route::resource('navs','Service\Admin\NavsController');
    //网站配置资源路由
    Route::resource('config','Service\Admin\ConfigController');

});

Route::get('validata/code','Service\ValidataController@create');

Route::get('404',function(){
    abort(404,'errors.404');
});
