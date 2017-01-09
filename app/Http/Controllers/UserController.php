<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
	public function checkAge($dob){
        $d = date("Y/m/d");
        $dt = new \DateTime($d);
        $dob = new \DateTime($dob);
        $diff = $dt->diff($dob)->format('%y');
        return $diff;
    }

    public function index(){
    	$user = \App\User::paginate(15);
    	foreach($user as $u){

    		$u->age=$this->checkAge($u->dob);
    	}
    	return view('user.index')->with('model',$user);
    }

    public function view($id){
    	$user = \App\User::find($id);
    	return view('user.view', ['user'=>$user]);
    }



    public function showEditForm($id){
    	$user = \App\User::find($id);
    	$roles = ['librarian'=>'Librarian', 'borrower'=>'Borrower'];
    	// return view('user.form', ['roles'=>$roles, 'me'=>'borrower']);
    	return view('user.form', ['roles'=>$roles, 'user'=>$user]);
    }
}
