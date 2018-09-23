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

use App\Http\Middleware\Admin;

Route::get('/', function () {
    return view('welcome');
});


Auth::routes();

Route::get('admin', 'HomeController@index')->name('admin');


Route::group(['middleware'=>['admin']],function (){

    Route::resource('admin/users','AdminUserController');

    Route::resource('admin/posts','AdminPostController');

    Route::resource('admin/categories','AdminCategoriesController');

});







