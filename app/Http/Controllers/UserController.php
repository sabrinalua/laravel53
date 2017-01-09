<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $r = null){
        $array=[];
        $key = ['id','email', 'type','name','first_name', 'last_name'];
    	if(!empty($r)){
            $array=[];
            $val = [$r['id'], $r['email'], $r['type'], $r['name'],$r['first_name'],$r['last_name']];
            for($i=0; $i<sizeof($val);$i++){
                $dove = $key[$i];
                $fly=$val[$i];
                $a=[];
                array_push($a, $dove);
                array_push($a, 'like');
                array_push($a, '%'.$fly.'%');
                array_push($array, $a);
            }
        }
        $user = \App\User::where($array)->paginate(15);
    	foreach($user as $u){

            $az = new \App\User();
            $log = \App\Log::where(['user_id'=>$u->id]);
            $log2 = \App\Log::where(['user_id'=>$u->id, 'returned'=>'0']);
    		$u->age=$az->checkAge($u->dob);
            $u->total = $log->count();
            $u->current = $log2->count();
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
