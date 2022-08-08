<?php

use Illuminate\Support\Facades\Route;

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

Auth::routes(['register' => false]);

Route::get("/", function () {
    return redirect()->to("/admin");
});

Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => 'auth'], function () {
    Route::get('/', 'DashboardController@index')->name("dashboard");
    Route::get('/map-url', 'DashboardController@mapData')->name("mapData");
    Route::get('/browser-usage', 'DashboardController@browserUsage')->name("browserUsage");
    Route::resource('categories', 'CategoriesController');

    Route::post('/import', 'CategoriesController@import')->name('categories.import');
    Route::get('/importExport', 'CategoriesController@importExportView')->name('categories.importExport');
    Route::resource('sample', 'SampleController@index');
    Route::post('sample/export', 'SampleController@index');

    Route::resource('emails', 'EmailsController');
    Route::get('/fetch-emails', 'EmailsController@fetchEmails')->name('fetch-emails');
    Route::post('/import', 'EmailsController@import')->name('mails.import');
    Route::get('/create-by-import', 'EmailsController@importView')->name('mails.importView');

    Route::resource('mails', 'MailsController');
    Route::resource('settings', 'SettingsController')->except(['update', 'destroy', 'edit', 'store', 'create']);
    Route::post("settings", "SettingsController@update")->name("settings.update");

    Route::post('ckeditor/image_upload', 'MailsController@upload')->name('image.upload');
//    Route::get("test-mail", "MailsController@composeEmail");
});

