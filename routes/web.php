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
// 「/でアクセスしたら、view('welcome')を返却する」となっている
// つまり、今回はControllerを介さずに、viewを返却している
Route::resource('todo', 'TodoController');  
//CRUD RoutingをTOdoController.phpに書いている
// 第一引数にはURI、第二引数にはファイル名
Auth::routes();
// vendor/laravel/framework/src/Illuminate/Routing/Routerのauthメソッドが呼ばれる

Route::get('/home', 'HomeController@index')->name('home');
// route listの追加？？　Nameがhomeのレコード部分
