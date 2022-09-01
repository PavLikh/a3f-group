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

// Route::get('/', function () {
//     return view('task1');
// })->name('task1');

Route::get('/', 'FirstTaskController@index')->name('task1');
Route::get('/task2', 'SecondTaskController@index')->name('task2');
Route::post('/task2', 'SecondTaskController@sortArr')->name('task2.sortArr');


// Route::get('/task2', function () {
//     return view('task2');
// })->name('task2');

Route::get('/task3', function () {
    return view('task3');
})->name('task3');
