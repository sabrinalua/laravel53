<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
	if(Auth::check()){
		return redirect()->action('HomeController@index');
	}else{return view('welcome');}
    
});

Auth::routes();

Route::get('/home', 'HomeController@index');

Route::get('/books', function(){
	return view('books.books');
});


//only accessible by user type librarians

Route::group(['middleware' => 'App\Http\Middleware\LibMidWare'], function(){
	Route::get('/addBook','HomeController@addBook');
	Route::get('/users', 'HomeController@users');
	Route::get('/userid', function(){
		echo "hi";
	});
});
