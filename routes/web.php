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
    return redirect()->route('download.index');
});

Auth::routes();
Route::get('user/activation/{token}/{referrer?}', 'Auth\RegisterController@activateUser')->name('user.activate');
Route::get('/support/download', 'DownloadController@index')->name('download.index');
Route::get('/support/download/windows', 'DownloadController@downloadWindows')->name('download.windows');
Route::get('/support/download/linux', 'DownloadController@downloadLinux')->name('download.linux');
Route::get('/support/download/mac', 'DownloadController@downloadMac')->name('download.mac');

Route::get('/support/publisherDownload', 'PublisherDownloadController@index')->name('publisherDownload.index');
Route::get('/support/publisherDownload/windows', 'PublisherDownloadController@downloadWindows')->name('publisherDownload.windows');
Route::get('/support/publisherDownload/linux', 'PublisherDownloadController@downloadLinux')->name('publisherDownload.linux');
Route::get('/support/publisherDownload/mac', 'PublisherDownloadController@downloadMac')->name('publisherDownload.mac');