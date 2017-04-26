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
Route::get('/user/profile', 'UserController@getTimeline');

Route::group(['middleware' => 'admin', 'prefix' => 'admin'], function () {
    Route::resource('/import-store', 'ImportStoreController');
    Route::resource('/import-store-detail', 'DetailImportStoreController');
    Route::post('/update-detail-store/{id}', 'DetailImportStoreController@update');
    Route::get('/delete-detail-store/{id}', 'DetailImportStoreController@destroy');
    Route::resource('/import-faculty', 'ImportFacultyController');
    Route::post('/store-faculty', 'ImportFacultyController@getImportFacultyByFaculty');
    Route::post('/delete-import-faculty', 'ImportFacultyController@destroy');
});

Route::group(['middleware' => 'accountant', 'prefix' => 'admin'], function () {

});

Route::group(['middleware' => 'store', 'prefix' => 'admin'], function () {

});

Route::group(['middleware' => 'faculty', 'prefix' => 'admin'], function () {

});

Route::group(['middleware' => 'room', 'prefix' => 'admin'], function () {

});

Route::get('logout', function() {
    Auth::logout();
    Session::flush();
    return redirect('/');
});

Route::get('importExport', 'MaatwebsiteDemoController@importExport');
Route::get('downloadExcel/{type}', 'MaatwebsiteDemoController@downloadExcel');
Route::post('importExcel', 'MaatwebsiteDemoController@importExcel');

Route::get('detail-import/{id}', 'DetailImportStoreController@getQuantityByStuffId');
