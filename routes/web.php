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
//发送验证码
Route::post('/VerificationCode/sendCode', "Tools\VerificationCodeController@sendCode")->name('VerificationCode.sendCode');

//主页
Route::get('/Home/index', "HomeController@index")->name('Home.index');
//个人资料
Route::get('/PersonalProfile/index', "PersonalProfileController@index")->name('PersonalProfile.index');
//商铺分类

Route::resource('ShopCate', "ShopCateController");
Route::get('/ShopCate/createSub/{id}', "ShopCateController@createSub")->name('ShopCate.createSub');
Route::post('/ShopCate/changeOne', "ShopCateController@changeOne")->name('ShopCate.changeOne');
Route::get('/ShopCate/goodsManage/{id}', "ShopCateController@goodsManage")->name('ShopCate.goodsManage');
Route::post('/ShopCate/cancelCate', "ShopCateController@cancelCate")->name('ShopCate.cancelCate');
Route::post('/ShopCate/order', "ShopCateController@order")->name('ShopCate.order');


//商品管理
Route::get('/GoodsManage/index', "GoodsManageController@index")->name('GoodsManage.index');
Route::get('/GoodsManage/create', "GoodsManageController@create")->name('GoodsManage.create');
Route::post('/GoodsManage/store', "GoodsManageController@store")->name('GoodsManage.store');
Route::post('/GoodsManage/getCate', "GoodsManageController@getCate")->name('GoodsManage.getCate');

Route::post('/GoodsManage/batchOp', "GoodsManageController@batchUp")->name('GoodsManage.batchUp');//批量上架
Route::post('/GoodsManage/batchDown', "GoodsManageController@batchDown")->name('GoodsManage.batchDown');//批量下架
Route::post('/GoodsManage/batchCate', "GoodsManageController@batchCate")->name('GoodsManage.batchCate');//批量分类
Route::post('/GoodsManage/op', "GoodsManageController@op")->name('GoodsManage.op');
Route::get('/GoodsManage/exportData', "GoodsManageController@exportData")->name('GoodsManage.exportData');
Route::get('/GoodsManage/edit/{id}', "GoodsManageController@edit")->name('GoodsManage.edit');
Route::post('/GoodsManage/destroy', "GoodsManageController@destroy")->name('GoodsManage.destroy');
Route::post('/GoodsManage/batchDestroy', "GoodsManageController@batchDestroy")->name('GoodsManage.batchDestroy');
//

Route::post('/Uploader/uploadImg', "Tools\UploaderController@uploadImg")->name('Uploader.uploadImg');
Route::post('/Uploader/uploadVideo', "Tools\UploaderController@uploadVideo")->name('Uploader.uploadVideo');
Route::post('/Uploader/deleteUploadImg', "Tools\UploaderController@deleteUploadImg")->name('Uploader.deleteUploadImg');

//有话说
Route::get('/talk/talkMe', "TalkController@talkMe")->name('Talk.talkMe');

//有话说接口

Route::get('/talk/getLginInfo', "TalkController@getLginInfo")->name('Talk.getLginInfo');//获取登录信息




