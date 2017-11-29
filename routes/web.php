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

Route::get('/', function () {
    return view('welcome');
}); 

Route::get('login',['as'=>'login','uses'=>'LoginController@getIndex']);
Route::post('login',['as'=>'login','uses'=>'LoginController@postLogin']);
Route::get('logout',['as'=>'logout','uses'=>'LoginController@getLogout']);

Route::group(['middleware' =>'auth'],function () {
 Route::group(['prefix'=>'ql_admin'],function(){
        Route::get('/',['uses'=>'AdminController@getListRoom']);
        Route::group(['prefix'=>'/phong'],function (){
            Route::get('danh-sach',['as'=>'danh-sach-phong','uses'=>'AdminController@getListRoom']);
            Route::post('them',['as'=>'them-phong','uses'=>'AdminController@postAddRoom']);
            Route::get('sua/{id}',['as'=>'sua-phong','uses'=>'AdminController@getEditRoom'])->where('id', '[0-9]+');
            Route::post('sua/{id}',['as'=>'sua-phong','uses'=>'AdminController@postEditRoom'])->where('id', '[0-9]+');
            Route::get('xoa/{id}',['as'=>'xoa-phong','uses'=>'AdminController@getDelRoom'])->where('id', '[0-9]+');
            Route::get('chitiet/{id}',['as'=>'chi-tiet','uses'=>'AdminController@getDeltail'])->where('id', '[0-9]+');
        });
        Route::group(['prefix'=>'nhom'],function (){
            Route::get('danh-sach',['as'=>'danh-sach-nhom','uses'=>'AdminController@getListGroup']);
            Route::post('them',['as'=>'them-nhom','uses'=>'AdminController@postAddGroup']);
            Route::get('sua/{id}',['as'=>'sua-nhom','uses'=>'AdminController@getEditGroup'])->where('id', '[0-9]+');
            Route::post('sua/{id}',['as'=>'sua-nhom','uses'=>'AdminController@postEditGroup'])->where('id', '[0-9]+');
            Route::get('xoa/{id}',['as'=>'xoa-nhom','uses'=>'AdminController@getDelGroup'])->where('id', '[0-9]+');
            Route::get('chitiet/{id}',['as'=>'chi-tiet','uses'=>'AdminController@getDetailGroup'])->where('id', '[0-9]+');
        });
        Route::group(['prefix'=>'nhanvien'],function (){
            Route::get('danh-sach',['as'=>'danh-sach-nhan-vien','uses'=>'AdminController@getListNv']);
            Route::post('them',['as'=>'them-nhan-vien','uses'=>'AdminController@postAddNv']);
            Route::get('sua/{id}',['as'=>'sua-nhan-vien','uses'=>'AdminController@getEditNv'])->where('id', '[0-9]+');
            Route::post('sua/{id}',['as'=>'sua-nhan-vien','uses'=>'AdminController@postEditNv'])->where('id', '[0-9]+');
            Route::get('xoa/{id}',['as'=>'xoa-nhan-vien','uses'=>'AdminController@getDelNv'])->where('id', '[0-9]+');
            Route::get('nhom-phong/{id}',['as'=>'danh-sach-nhom-phong','uses'=>'AdminController@getChangeSlt'])->where('id', '[0-9]+');
            Route::get('tim-kiem/{name?}',['as'=>'danh-sach-tim-kiem','uses'=>'AdminController@getDataSearch']);
            Route::get('sap-xep/{sx}',['as'=>'danh-sach-sap-xep','uses'=>'AdminController@getDataSort']);

        });

    });
});


