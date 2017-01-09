<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SiteController extends Controller
{
    public function logs(){
    	$uid= \Auth::user()->id;
    	$log = \App\Log::where(['user_id'=>$uid])->orderBy('id', 'desc')->paginate(15);
        $d = date("Y/m/d");
        // $d = date('2017/3/12');
        $dt = new \DateTime($d);
        // var_dump($dt);
        // exit();

    	foreach($log as $l){
    		// echo $l->id;
    		$l->book_title = \App\Books::find($l->book_id)->title;
            $dd = new \DateTime($l->due_date);
            $l->diff = $dd->diff($dt)->format('%r%d');
            if($l->diff > 0){
                $l->overdue = true;
                $l->fine = ($l->diff)*2;
            }
    	}
    	return view('site.log', ['log'=>$log]);

    }

    public function password(){
    	
    }
}
