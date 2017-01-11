<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Books;
use Illuminate\Database\Eloquent\ModelNotFoundException;

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
        $number = (int)$book['copies'];
        $num1 = $number+1;
        $d =0;
        for($i=0; $i<$number; $i++){
            $model = new Books();
            $model->title = $book['title'];
            $model->isbn = $book['isbn'];
            $model->author = $book['author_fn']." ".$book['author_ln' ];
            $model->location = $book['location'];
            $model->added_by = $added_by;
            $model->publisher = $book['publisher'];
            $model->publish_year = $book['publish_year'];
            $model->description =$book['description'];
            $model->price = $book['price'];
            if($model->save()){
                $d++;
            }
        }
        
    	// $model = new Books();
    	// $model->title = $book['title'];
    	// $model->isbn = $book['isbn'];
    	// $model->author = $book['author_fn']." ".$book['author_ln' ];
    	// $model->location = $book['location'];
     //    $model->added_by = $added_by;
     //    $model->publisher = $book['publisher'];
     //    $model->publish_year = $book['publish_year'];
     //    $model->description =$book['description'];
     //    $model->price = $book['price'];

    	if($d==$number){
    		return \Redirect::route('booklist');
    	}else{
    		// return \Redirect::route('bookcreate');
            return redirect()->action('BookController@showCreateForm');
    	}
    }

    public function view($id){
        if($book = Books::find($id)){
           return view('books.view', ['book'=>$book]); 
       }else{
        return \Redirect::route('error');
       }    	
    }

    public function showRenewForm($id){
        if($log = \App\Log::find($id)){
            if($log->user_id == \Auth::user()->id && $log->returned==0){
                $d = date("Y/m/d");
                $dt = new \DateTime($d);
                $dd = new \DateTime($log->due_date);
                $diff = $dd->diff($dt)->format('%r%a');
                if($diff>0){
                    return \Redirect::route('selflog');
                }else{
                    $now = $this->getNow();
                    $return = $this->getNow()->modify('+2 month');
                    $book =Books::find($log->book_id); 
                    return view('books.renew', ['log'=>$log, 'now'=>$now, 'return'=>$return, 'book'=>$book]);
                }
                return view('books.renew');
            }else{
                return \Redirect::route('selflog');
            }
        }else{
            return \Redirect::route('selflog');
        }
    }

    public function renews(Request $r){
        $oldLog = \App\Log::find($r['OldLog']['id']);
        $post = $r['NewLog'];

        $oldLog->returned ='1';
        $oldLog->return_date = $this->getNow();
        if($oldLog->save()){
            $newLog = new \App\Log();
            $newLog->book_id = $post['book_id'];
            $newLog->user_id = $post['user_id'];
            $newLog->borrow_date = $post['borrow_date'];
            $newLog->due_date = $post['due_date'];
            if($newLog->save()){
                return \Redirect::route('selflog');
            }
        }
        // var_dump($r['NewLog']);

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
        if($book = Books::find($id)){
            $sections = \App\Section::all();
            return view('books.update', ['book'=>$book, 'section'=>$sections]);
        }else{
            return \Redirect::route('error');
        }
    }

    public function update(Request $r){
        $up = $r['Book'];
        $book = Books::find($up['id']);
        
        $book->description = $up['description'];
        $book->location = $up['location'];
        $book->price = $up['price'];
        $book->publish_year = $up['year'];
        if($up['found']=='available'){
            $book->status = $up['found'];
        }
        if($book->save()){
            return \Redirect::route('/viewbook', ['id'=>$up['id']]);
        }
        // var_dump($up);
    }

    public function showReturnForm2($id){
        if($log=\App\Log::find($id)){
            if(\Auth::user()->id !=$log->user_id){
                return \Redirect::route('error');
            }else{
                $book = Books::find($log->book_id)->title;
                $now = $this->getNow();
                $borrower =\App\User::find($log->user_id)->name;
                return view('books.return', ['log'=>$log, 'borrower'=>$borrower, 'book'=>$book, 'return'=>$now]);
            }
        }else{
            return \Redirect::route('error');
        }
    }

    public function showReturnForm($id){
        $d = date("Y/m/d");
        $dt = new \DateTime($d);

        if($log = \App\Log::find($id)){
            $dd = new \DateTime($log->due_date);
            $diff = $dd->diff($dt)->format('%r%a');
            // $log->diff = $diff;
            $od = false;
            if($diff>0){
                $od = true;
            }
            if($log->returned =='0' && !$od){
                $book = Books::find($log->book_id);
                $now = $this->getNow();
                $borrower =\App\User::find($log->user_id);
                return view('books.return', ['log'=>$log, 'borrower'=>$borrower, 'book'=>$book, 'return'=>$now]);
            }
            elseif($log->reuturned ==0 && $od){
                return \Redirect::route('report', ['id'=>$log->id]);
            }else{
                return \Redirect::route('loglist');
            }
            
        }else{
            // echo "error";
            return \Redirect::route('loglist');
        }
    }

    public function returns(Request $r){
        $post = $r['Log'];
        $log = \App\Log::find($post['id']);
        $log->return_date = $post['return_date'];
        $log->returned ='1';
        if($log->save()){
            $book =  Books::find($post['book_id']);
            if($book->status=="lost"){
                return \Redirect::route('error');
            }else{
                $book->status ="available";
                if($book->save()){
                    return \Redirect('\home');
                }
            }            
        }
    }

    public function showBorrowForm($id){
        if($book = Books::find($id)){
            if($book->status =='borrowed' || $book->status=='lost'){
                return \Redirect::route('/viewbook', ['id'=>$book->id]);
            }else{
                $now = $this->getNow();
                $return = $this->getNow()->modify('+2 month');    
                return view('books.borrow', ['book'=>$book, 'now'=>$now, 'return'=>$return]);
            }
        }else{
            return \Redirect::route('error');
        } 
    }

    public function borrow(Request $request){
        $temp = new \App\User();
        $age = $temp->checkAge(\Auth::user()->dob);
        $age = (int)$age;
        if($age>= 16){
            $max=6;
        }if($age<16){
            $max =4;
        }
        $current_total =\App\Log::where(['user_id'=>\Auth::user()->id, 'returned'=>'0'])->count();
        if($current_total==$max){
            $request->session()->flash('status', 'return your curent borrowed books first!');
            return \Redirect::route('/home');
        }else{
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

    public function showReportForm($id){
        if($log = \App\Log::find($id)){
            if($log->returned==1){
                return \Redirect::route('loglist');
            }else{
                $dt = $this->getNow();
                $dd = new \DateTime($log->due_date);
                $diff = $dd->diff($dt)->format('%r%a');
                $log->diff = $diff;
                if($diff>0){
                $log->fine = $diff*2;}
                else{
                    $log->fine =0;
                }
                $book = Books::find($log->book_id);
                $user  =\App\User::find($log->user_id);
                $log->return_date = $this->getNow();
                return view ('books.report', ['log'=>$log, 'book'=>$book, 'user'=>$user]);
            }
        }else{
            return \Redirect::route('loglist');
        }        
    }
    public function reporting(Request $r){
        $post = $r['Fines'];
            $log = \App\Log::find($post['log_id']);
            $user_id = $post['user_id'];
            $book = Books::find($post['book_id']);
            $log->returned = '1';
            $log->return_date = $post['return_date'];
            $fines = $post['total_fines'];

            $flag_lost =0;
            $flag_fined = 0;
            $book_status="available";

            if($post['type']=='lost'){
                $flag_lost =1;
                $book_status = "lost";
            }
            if($fines>0){$flag_fined = 1;}

            if($flag_lost){
                // echo "update log, book, fines";
                if($log->save()){
                    $book->status = $book_status;
                    if($book->save()){
                        $finemodel = new \App\Fines();
                        $finemodel->comment = $post['comment'];
                        $finemodel->log_id = $post['log_id'];
                        $finemodel->book_id = $post['book_id'];
                        $finemodel->user_id = $post['user_id'];
                        $finemodel->type = $post['type'];
                        $finemodel->logged_by = \Auth::user()->id;
                        $finemodel->total_fines = $fines;
                        if($finemodel->save()){
                            $msg= 'successfully reported lost book';
                            $r->session()->flash('status', $msg);
                            return \Redirect::route('loglist');
                        }
                    }
                }
            }
            if(!$flag_lost){
                    if($log->save()){
                        $book->status = $book_status;
                        if($book->save()){
                            $msg= "Thanks for returning the books on time";
                            $r->session()->flash('status', $msg);
                            return \Redirect::route('loglist');
                        }
                    }
                if($flag_fined){
                    $finemodel = new \App\Fines();
                        $finemodel->log_id = $post['log_id'];
                        $finemodel->book_id = $post['book_id'];
                        $finemodel->user_id = $post['user_id'];
                        $finemodel->type = $post['type'];
                        $finemodel->logged_by = \Auth::user()->id;
                        $finemodel->total_fines = $fines;
                        if($finemodel->save()){
                            $msg= 'successfully fined on late return';
                            $r->session()->flash('status', $msg);
                            return \Redirect::route('loglist');
                    }
                }                
            }  
    }
}
