<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;
    public $age;
    public $total;
    public $current;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'dob', 'type', 'contact', 'address',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    public function checkAge($dob){
        $d = date("Y/m/d");
        $dt = new \DateTime($d);
        $dob = new \DateTime($dob);
        $diff = $dt->diff($dob)->format('%y');
        return $diff;
    }
}
