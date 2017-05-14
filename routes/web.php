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
    return view('auth.login');
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
    Route::get('/atrophy-store', [
        'as' => 'atrophy-store',
        'uses' => 'AtrophyController@getExpireStuffStore'
    ]);
    Route::get('/delete-atrophy-store/{id}', [
        'as' => 'delete-atrophy-store',
        'uses' => 'AtrophyController@destroy'
    ]);
    Route::get('/delete-atrophy-faculty/{id}', 'AtrophyController@destroyFaculty');
    Route::get('/delete-atrophy-room/{id}', 'AtrophyController@destroyRoom');
    Route::get('/request', [
        'as' => 'request',
        'uses' => 'RequestController@getAll'
    ]);
    Route::get('/request-accept/{id}', [
        'as' => 'request-accept',
        'uses' => 'RequestController@acceptRequest'
    ]);
    Route::get('/liquidation', [
        'as' => 'liquidation',
        'uses' => 'LiquidationController@getAllLiquidation'
    ]);
    Route::get('/request-accept-all', [
        'as' => 'request-accept-all',
        'uses' => 'RequestController@acceptAllRequest'
    ]);
});

Route::get('/messages', 'MessageController@getAmountExpireStuff');
Route::get('/amount-request', 'RequestController@countRequestLiquidation');

Route::group(['middleware' => 'faculty', 'prefix' => 'fac'], function () {
    Route::resource('/store-room', 'ImportRoomController');
    Route::post('/store-room-delete', 'ImportRoomController@destroy');
    Route::get('/store-room-list', [
        'as' => 'store-room-list',
        'uses' => 'ImportRoomController@index'
    ]);
    Route::get('/store-faculty-list', [
        'as' => 'store-faculty-list',
        'uses' => 'ImportFacultyController@getImportFacultyByOwnFaculty'
    ]);
    Route::post('/store-room-fac',  [
        'as' => 'store-room-fac',
        'uses' => 'ImportRoomController@getImportRoomByFaculty'
    ]);
    Route::get('/detail-store-faculty/{id}', [
        'as' => 'detail-store-faculty',
        'uses' => 'HistoryImportController@getStoreRoomByStoreFaculty'
    ]);
    Route::get('/statis-faculty-year', [
        'as' => 'statis-faculty-year',
        'uses' => 'StatisticalController@statisticByFacultyYear'
    ]);
    Route::post('/statis-faculty-by-year', [
        'as' => 'statis-faculty-by-year',
        'uses' => 'StatisticalController@statisticByFacultyByYear'
    ]);
    Route::get('/statis-room-year', [
        'as' => 'statis-room-year',
        'uses' => 'StatisticalController@statisticByRoomYear'
    ]);
    Route::post('/statis-by-room-year', [
        'as' => 'statis-by-room-year',
        'uses' => 'StatisticalController@statisticByRoomByYear'
    ]);
    Route::get('/statis-faculty-year-detail/{year}/{stuff}', 'StatisticalController@detailStatisticByFacultyYearStuff');
    Route::get('/atrophy-store', [
        'as' => 'atrophy-store-faculty',
        'uses' => 'AtrophyController@getExpireStuffStoreFaculty'
    ]);
    Route::post('/request-liquidation', [
        'as' => 'request-liquidation-faculty',
        'uses' => 'RequestController@storeFaculty'
    ]);
    Route::get('/liquidation-faculty', [
        'as' => 'liquidation-faculty',
        'uses' => 'LiquidationController@getLiquiByFaculty'
    ]);
});

Route::group(['middleware' => 'room', 'prefix' => 'roo'], function () {
    Route::get('/atrophy-store', [
        'as' => 'atrophy-store-room',
        'uses' => 'AtrophyController@getExpireStuffStoreRoom'
    ]);
    Route::post('/request-liquidation', [
        'as' => 'request-liquidation-room',
        'uses' => 'RequestController@storeRoom'
    ]);
    Route::get('/store-room-user', [
        'as' => 'store-room-user',
        'uses' => 'ImportRoomController@getImportRoomByRoom'
    ]);
});

Route::get('logout', function() {
    Auth::logout();
    Session::flush();
    return redirect('/');
});

Route::get('download-liquidation', [
    'as'  => 'download-liquidation',
    'uses' => 'ExportExcelController@downloadStatistic'
]);
Route::get('d-detail/{id}', 'ExportExcelController@downloadDetailImportStoreById');

Route::get('detail-import/{id}', 'DetailImportStoreController@getQuantityByStuffId');
Route::get('amount-stuff-faculty/{id}', 'ImportRoomController@getQuantityByStuffId');
