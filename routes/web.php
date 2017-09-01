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
Route::get('/',function (){
    return redirect()->route('Login.showLogin');
});
//登录
Route::get('/Login/showLogin', "LoginController@showLogin")->name('Login.showLogin');
Route::post('/Login/doLogin', "LoginController@doLogin")->name('Login.doLogin');
Route::get('/Login/logout', "LoginController@logout")->name('Login.logout');

//主页
Route::get('/Home/index', "HomeController@index")->name('Home.index');
//个人资料
Route::get('/PersonalProfile/index', "PersonalProfileController@index")->name('PersonalProfile.index');
//商铺分类
Route::get('/ShopCate/index', "ShopCateController@index")->name('ShopCate.index');
//商品管理
Route::get('/GoodsManage/index', "GoodsManageController@index")->name('GoodsManage.index');
Route::get('/GoodsManage/create', "GoodsManageController@create")->name('GoodsManage.create');
Route::post('/GoodsManage/store', "GoodsManageController@store")->name('GoodsManage.store');

Route::post('/Uploader/uploadImg', "Tools\UploaderController@uploadImg")->name('Uploader.uploadImg');
Route::post('/Uploader/deleteUploadImg', "Tools\UploaderController@deleteUploadImg")->name('Uploader.deleteUploadImg');




