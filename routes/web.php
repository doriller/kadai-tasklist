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

Route::get('/', 'TasksController@index');


Route::resource('tasks', 'TasksController');
/*Route::get('tasks/{id}', 'TasksController@show');
Route::post('tasks', 'TasksController@store');
Route::put('tasks/{id}', 'TasksController@update');
Route::delete('tasks/{id}', 'TasksController@destroy');
Route::get('tasks', 'TasksController@index')->name('tasks.index');
Route::get('tasks/create', 'TasksController@create')->name('tasks.create');
Route::get('tasks/{id}/edit', 'TasksController@edit')->name('tasks.edit');*/
