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

Route::get('/', 'FirstTaskController@index')->name('task1');
Route::get('/task2', 'SecondTaskController@index')->name('task2.index');
Route::post('/task2', 'SecondTaskController@sortArr')->name('task2.sortArr');
Route::get('/task3', 'ThirdTaskController@index')->name('task3.index');
Route::post('/task3', 'ThirdTaskController@showHtmlTags')->name('task3.showHtmlTags');
