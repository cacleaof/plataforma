<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::get('/data', 'App\Http\Controllers\Admin\GanttController@get');

Route::resource('task', 'App\Http\Controllers\Admin\TaskController');

Route::resource('link', 'App\Http\Controllers\Admin\LinkController');
