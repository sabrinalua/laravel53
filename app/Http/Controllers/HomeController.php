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

    public function checkAge($dob){
        $d = date("Y/m/d");
        $dt = new \DateTime($d);
        $dob = new \DateTime($dob);
        $diff = $dt->diff($dob)->format('%y');
        return $diff;

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {  
        $dob =\Auth::user()->dob;
        $diff = $this->checkAge($dob);        
        return view('home', ['age'=>$diff]);
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
