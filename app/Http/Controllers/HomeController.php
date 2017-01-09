<?php

namespace App\Http\Controllers;
use App\Users ;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    private $type;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {  
        $a =new \App\User();
        
        $dob =\Auth::user()->dob;
        $diff = $a->checkAge($dob);
        $log = \App\Log::where(['user_id'=>\Auth::user()->id, 'returned'=>'0'])->get();
        $count = $log->count();
        $count_total =  \App\Log::where(['user_id'=>\Auth::user()->id])->get()->count();      
        return view('home', ['age'=>$diff, 'count'=>$count, 'count_ttl'=>$count_total]);
    }

    public function addBook(){
        // $this->check();
        // echo json_encode(Users::all());
    }
    public function users(){
        $users = Users::all();
        foreach($users as $u){
            echo $u->name. "->". $u->email;
            echo "<br>";
        }
    }
}
