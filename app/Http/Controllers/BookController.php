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

    public function getNow(){
        $d = date("Y/m/d");
        $dt = new \DateTime($d);
        return $dt;
    }

    public function showCreateForm(){
        $sections = \App\Section::all();
    	return view('books.create', ['sections'=>$sections]);
    }
    public function create(Request $request){
    	$added_by = \Auth::user()->name;
    	$book = $request['Book'];
    	$model = new Books();
    	$model->title = $book['title'];
    	$model->isbn = $book['isbn'];
    	$model->author = $book['author_fn']." ".$book['author_ln' ];
    	$model->location = $book['location'];
        $model->added_by = $added_by;
        $model->description =$book['description'];

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

    public function index(Request $r=null){ 
        $key = ['title', 'author', 'isbn','status'];

        if(!empty($r)){
            $array=[];
            $val =[];
            $val[0]= $r['title'];
            $val[1]=$r['author'];
            $val[2]=$r['isbn'];
            $val[3]=$r['status']; 
            for($i=0; $i<sizeof($val); $i++){
                $dove = $key[$i];
                $fly=$val[$i];
                $a=[];
                array_push($a, $dove);
                array_push($a, 'like');
                array_push($a, '%'.$fly.'%');
                array_push($array, $a);
            }
        }
        
        $model= Books::where($array)->paginate(15);
    	// $model = Books::paginate(15);
    	return view('books.index')->with('model',$model);
    	
    }
    public function showEditForm($id){
    	echo "update ".$id;
    }
    public function update(){

    }

    public function showBorrowForm($id){
        $book = \App\Books::find($id);
        $now = $this->getNow();
        $return = $this->getNow()->modify('+2 month');
        
        return view('books.borrow', ['book'=>$book, 'now'=>$now, 'return'=>$return]);
    }
    public function borrow(Request $request){
        $log = $request['Log'];        
        $model = new \App\Log();
        $model->user_id = \Auth::user()->id;
        $model->book_id = $log['book_id'];
        $model->borrow_date =$log['borrow_date'];
        $model->due_date =$log['due_date'];
        if($model->save()){
            $book = Books::find($log['book_id']);
            $book->status ="borrowed";
            if($book->save()){
                return \Redirect::route('booklist');}
        }

    }
}
