<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SiteController extends Controller
{
    public function logs(){
    	$uid= \Auth::user()->id;
    	$log = \App\Log::where(['user_id'=>$uid])->paginate(15);
    	foreach($log as $l){
    		// echo $l->id;
    		$l->book_title = \App\Books::find($l->book_id)->title;
    	}

    	// var_dump($log);
    	//select fron logs where user
    	//dump the stuff into view
    	return view('site.log', ['log'=>$log]);

    }

    public function password(){
    	
    }
}
