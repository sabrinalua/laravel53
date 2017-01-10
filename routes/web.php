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
Auth::routes();
Route::get('/home', 'HomeController@index')->name('/home');

Route::get('/change_password', function(){
	Auth::logout();
	return redirect('/home');
});
Route::get('/info', function(){});
Route::post('/info', function(){});

Route::post('/register', function(){return \Redirect::route('error');});
Route::get('/register', function(){return \Redirect::route('error');});

Route::get('/', function () {
	if(Auth::check()){
		return redirect()->action('HomeController@index');
	}else{return view('auth.login');}
    
});

//list books
Route::get('/books/list', 'BookController@index')->name('booklist'); 
Route::post('/books/list', 'BookController@index'); 
//view book by ID
Route::get('/books/view/{id}', 'BookController@view')->name('/viewbook');

Route::get('/error', function(){return view('error');})->name('error');

//verified users
Route::group(['middleware'=>'App\Http\Middleware\VeriMidware'], function(){
	//usertype = admin
	Route::group(['middleware' => 'App\Http\Middleware\LibMidWare'], function(){
			
		//books
		Route::get('/books/create', 'BookController@showCreateForm');
		Route::post('/books/create', 'BookController@create');
		Route::get('/books/update/{id}', 'BookController@showEditForm');
		Route::post('/books/update', 'BookController@update');
		
		Route::get('books/return/{id}','BookController@showReportForm');
		// Route::post('/books/return', 'BookController@returns');
		
		Route::get('/books/report/{id}', 'BookController@showReportForm')->name('report'); //lost or late return book
		Route::post('/books/report', 'BookController@reporting');

		//users
		Route::get('/users/list', 'UserController@index')->name('userlist');
		Route::post('/users/list', 'UserController@index');
		Route::get('/users/view/{id}', 'UserController@view')->name('/viewuser');
		route::get('/users/update/{id}', 'UserController@showEditForm');
		Route::put('/users/update', 'BookController@update');
		Route::get('/users/create', 'UserController@showCreateForm');
		Route::post('/users/create', 'UserController@create');

		//logs
		Route::get('/logs/list', 'LogController@index')->name('loglist');
		Route::post('/logs/list', 'LogController@index');
		Route::get('/fines', 'HomeController@fines');
	});	
	Route::get('/books/borrow/{id}','BookController@showBorrowForm');
	Route::post('books/borrow', 'BookController@borrow');
	
	// Route::get('books/return/{id}','BookController@showReturnForm');
	// Route::post('/books/return', 'BookController@returns');

	Route::get('/logs', 'HomeController@logs')->name('selflog');
	Route::get('/password', 'HomeController@password')->name('pw');
	Route::post('/password', 'HomeController@chgPw');

	Route::get('/books/renew/{id}', 'BookController@showRenewForm');
	Route::post('/books/renew', 'BookController@renews');
});

