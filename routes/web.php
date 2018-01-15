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


//Route::get('/', 'PatternController@search');

//Route::get('/', function () {
//    return view('welcome');
//});

//Route::post('/SearchRequest', function(){
//    if(Request::ajax()){
//        return var_dump(Response::json(Request::all()));
//    }
//});


//Route::get('/search', 'PatternController@search');

Route::get('/', 'PatternController@index');

Route::get('/search', 'PatternController@searchResults');