<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Log;
use \App\Books;
use \App\User;

class LogController extends Controller
{
    public function index(Request $r=null){
        $array =[];

        $key = ['user_id', 'book_id'];

        if(!empty($r)){
            $val = [$r['user_id'], $r['book_id']];
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
    	$log= Log::where($array)->paginate(15);
    	$d = date("Y/m/d");
        $dt = new \DateTime($d);
    	foreach($log as $l){
    		// echo $l->id;
    		$l->book_title = Books::find($l->book_id)->title;
    		$l->borrower = User::find($l->user_id)->name;
            $dd = new \DateTime($l->due_date);
            $l->diff = $dd->diff($dt)->format('%r%a');
            if($l->diff > 0){
                $l->overdue = true;
                $l->fine = ($l->diff)*2;
            }
    	}
    	return view('log.index', ['logs'=>$log]);
    }
}
