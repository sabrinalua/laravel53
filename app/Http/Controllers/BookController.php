<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Books;

class BookController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
    }

    public function showCreateForm(){
    	return view('books.create');
    }
    public function create(Request $request){
    	$added_by = \Auth::user()->name;
    	$book = $request['Book'];
    	$model = new Books();
    	$model->title = $book['title'];
    	$model->isbn = $book['isbn'];
    	$model->author = $book['author_fn']." ".$book['author_ln' ];
    	$model->location = $book['location'];

    	if($model->save()){
    		return \Redirect::route('/viewbook', ['id'=>$model->id]);
    	}else{
    		return view('books.create'); 
    	}
    }

    public function view($id){
    	$book = Books::find($id);
    	return view('books.view', ['book'=>$book]);
    }

    public function index(){   	
    	$model = Books::paginate(15);
    	return view('books.index')->with('model',$model);
    	
    }
    public function showEditForm($id){
    	echo "update ".$id;
    }
    public function update(){

    }
}
