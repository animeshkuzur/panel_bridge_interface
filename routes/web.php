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

/*Route::get('/', function () {
    return view('welcome');
});*/

//Auth::routes();

//Route::get('/', 'HomeController@index')->name('home');

Route::get('/login',['as'=>'login','uses'=>'AuthController@login']);
Route::post('/login',['as'=>'authLogin','uses'=>'AuthController@authLogin']);
Route::get('/settings',['middleware'=>'enable.lock','as'=>'settings','uses'=>'AuthController@settings']);
Route::post('/settings',['middleware'=>'enable.lock','as'=>'saveSettings','uses'=>'AuthController@saveSettings']);

Route::get('/',['as'=>'index','uses'=>'EnableDeviceController@index']);
Route::post('/',['as'=>'enable','uses'=>'EnableDeviceController@enable']);
Route::get('/configure',['middleware'=>'enable.lock','as'=>'configure','uses'=>'ConfigureController@configure']);

Route::get('/sbus',['middleware'=>'enable.lock','as'=>'sbus','uses'=>'ConfigureController@sbus']);
Route::post('/sbus/add/device',['middleware'=>'enable.lock','as'=>'sbus/add/device','uses'=>'ConfigureController@sbus_add_device']);
Route::post('/sbus/add/gateway',['middleware'=>'enable.lock','as'=>'sbus/add/gateway','uses'=>'ConfigureController@sbus_add_gateway']);
Route::post('/sbus/add/button',['middleware'=>'enable.lock','as'=>'sbus/add/button','uses'=>'ConfigureController@sbus_add_button']);
Route::get('/sbus/{id}/delete/device',['middleware'=>'enable.lock','as'=>'sbus/delete/device','uses'=>'ConfigureController@sbus_delete_device']);
Route::get('/sbus/{id}/delete/gateway',['middleware'=>'enable.lock','as'=>'sbus/delete/gateway','uses'=>'ConfigureController@sbus_delete_gateway']);
Route::get('/sbus/{id}/delete/button',['middleware'=>'enable.lock','as'=>'sbus/delete/button','uses'=>'ConfigureController@sbus_delete_button']);
Route::post('/sbus/{id}/edit/device',['middleware'=>'enable.lock','as'=>'sbus/edit/device','uses'=>'ConfigureController@sbus_edit_device']);

Route::get('/zmote',['middleware'=>'enable.lock','as'=>'zmote','uses'=>'ConfigureController@zmote']);
Route::post('/zmote/add/device',['middleware'=>'enable.lock','as'=>'zmote/add/device','uses'=>'ConfigureController@zmote_add_device']);
Route::post('/zmote/add/zmote',['middleware'=>'enable.lock','as'=>'zmote/add/zmote','uses'=>'ConfigureController@zmote_add_zmote']);
Route::post('/zmote/add/button',['middleware'=>'enable.lock','as'=>'zmote/add/button','uses'=>'ConfigureController@zmote_add_button']);
Route::get('/zmote/{id}/delete/device',['middleware'=>'enable.lock','as'=>'zmote/delete/device','uses'=>'ConfigureController@zmote_delete_device']);
Route::get('/zmote/{id}/delete/zmote',['middleware'=>'enable.lock','as'=>'zmote/delete/zmote','uses'=>'ConfigureController@zmote_delete_zmote']);
Route::get('/zmote/{id}/delete/button',['middleware'=>'enable.lock','as'=>'zmote/delete/button','uses'=>'ConfigureController@zmote_delete_button']);

Route::get('/reset',['middleware'=>'enable.lock','as'=>'reset','uses'=>'ConfigureController@reset']);
Route::get('/reboot',['middleware'=>'enable.lock','as'=>'reboot','uses'=>'ConfigureController@reboot']);