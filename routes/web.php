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
    Route::get('/atrophy-store', 'AtrophyController@getExpireStuffStore');
    Route::get('/delete-atrophy-store/{id}', 'AtrophyController@destroy');
    Route::get('/messages', 'MessageController@getAmountExpireStuff');
});

Route::group(['middleware' => 'accountant', 'prefix' => 'acc'], function () {

});

Route::group(['middleware' => 'faculty', 'prefix' => 'fac'], function () {
    Route::resource('/store-room', 'ImportRoomController');
    Route::post('/store-room-delete', 'ImportRoomController@destroy');
    Route::get('/store-room-list', 'ImportRoomController@index');
    Route::get('/store-faculty-list', 'ImportFacultyController@getImportFacultyByOwnFaculty');
    Route::post('/store-room-fac', 'ImportRoomController@getImportRoomByFaculty');
    Route::get('/detail-store-faculty/{id}', 'HistoryImportController@getStoreRoomByStoreFaculty');
    Route::get('/statis-faculty-year', 'StatisticalController@statisticByFacultyYear');
    Route::post('/statis-faculty-by-year', 'StatisticalController@statisticByFacultyByYear');
    Route::get('/statis-room-year', 'StatisticalController@statisticByRoomYear');
    Route::post('/statis-by-room-year', 'StatisticalController@statisticByRoomByYear');
    Route::get('/statis-faculty-year-detail/{year}/{stuff}', 'StatisticalController@detailStatisticByFacultyYearStuff');
});

Route::group(['middleware' => 'room', 'prefix' => 'roo'], function () {

});

Route::get('logout', function() {
    Auth::logout();
    Session::flush();
    return redirect('/');
});

Route::get('importExport', 'MaatwebsiteDemoController@importExport');
Route::get('downloadExcel/{type}', 'MaatwebsiteDemoController@downloadExcel');
Route::get('d-detail/{id}', 'ExportExcelController@downloadDetailImportStoreById');
Route::post('importExcel', 'MaatwebsiteDemoController@importExcel');

Route::get('detail-import/{id}', 'DetailImportStoreController@getQuantityByStuffId');
Route::get('amount-stuff-faculty/{id}', 'ImportRoomController@getQuantityByStuffId');
