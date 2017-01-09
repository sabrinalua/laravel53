<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    //
    protected $table = "logs";
    public $timestamps =false;
    public $book_title;
    public $overdue = false;
    public $diff; 
    public $fine =0;
    public $borrower;
}
