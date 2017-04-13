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

Auth::routes();

Route::get('/home', 'HomeController@index');
//'middleware' => 'admin', 
Route::group(['prefix' => 'admin'], function () {
    Route::resource('/import-store', 'ImportStoreController');
    Route::resource('/import-store-detail', 'DetailImportStoreController');
    Route::resource('/import-faculty', 'ImportFacultyController');
});

Route::get('logout', function() {
    Auth::logout();
    Session::flush();
    return redirect('/');
});

    Route::get('detail-import/{id}', 'DetailImportStoreController@getDetailByStuffId');