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

Route::get('/home', 'HomeController@index')->name('home');

// // // Creating by Q
// Route::get('/manyViews', function (){
//     return view('hello');
// });

Route::get('/manyViews',['uses'=> 'getDataController@index']);
Route::post('/manyViews/chao',['uses'=> 'getDataController@handleRequest']);

Route::get('/test',['uses'=> 'TestFormController@index']);