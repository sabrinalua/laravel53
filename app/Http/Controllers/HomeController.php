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
        $d = date("Y/m/d");
        $dt = new \DateTime($d);
        $od_count=0;
        $ttl_fine =0;
        $od=false;
        foreach($log as $l){
            $l->book_title = \App\Books::find($l->book_id)->title;
            $dd = new \DateTime($l->due_date);
            $l->diff = $dd->diff($dt)->format('%r%a');
            if($l->diff > 0){
                if($l->returned=='1'){
                    $od = false;
                }elseif ($l->returned =='0') {
                    $od=true;
                    $od_count=$od_count+1;
                    $x = ($l->diff)*2;
                    $ttl_fine = $ttl_fine+$x;
                }                
            }
        }      
        return view('home', ['age'=>$diff, 'count'=>$count, 'count_ttl'=>$count_total, 'od_count'=>$od_count, 'ttl_fine'=>$ttl_fine, 'od'=>$od]);
    }

    public function logs(){
        $uid= \Auth::user()->id;
        $log = \App\Log::where(['user_id'=>$uid])->orderBy('id', 'desc')->paginate(5);
        $d = date("Y/m/d");

        $dt = new \DateTime($d);

        foreach($log as $l){
            // echo $l->id;
            $l->book_title = \App\Books::find($l->book_id)->title;
            $dd = new \DateTime($l->due_date);
            $l->diff = $dd->diff($dt)->format('%r%a');
            if($l->diff > 0){
                $l->overdue = true;
                $l->fine = ($l->diff)*2;
            }
        }
        return view('site.log', ['log'=>$log]);

    }

    public function password(){
        return view('site.chg_password');
    }

    public function fines(){
        $fines = \App\Fines::paginate(15);
        $ttl =0;
        foreach ($fines as $f) {
            $ttl = $ttl + $f['total_fines'];
        }
        return view('log.fines', ['fines'=>$fines, 'ttl'=>$ttl]);
    }
    public function chgPw(Request $r){
        $post = $r['Pw'];

        $cur = \Auth::user()->password;
        $input_old = $post['old'];
        $p1 = $post['p1'];
        $p2 = $post['p2'];//use this as new value
        if(\Hash::check($input_old, $cur) && $p1==$p2){
            $user = \App\User::find(\Auth::user()->id);
            $user->password= bcrypt($p2);
            if($user->save()){
                \Auth::logout();
                $r->session()->flash('pw_success', 'Password changed. please login again ');
                return \Redirect::route('login');
            }
        }else{
            $r->session()->flash('pw_error', 'unable to change password. pls try again');
            return \Redirect::route('pw');
        }
    }
    
}
