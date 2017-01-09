<?php

use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\User::create([
            'name' => "Manji",
            'first_name'=>'Manji',
            'last_name'=>'Kurosawa',
            'designation'=>'Mr',
            'email' => "admin@admin.com",
            'password' => bcrypt('123456'),
            'dob'=>'1992-12-12',
            'type'=>'librarian',
            'contact'=>'12345',
            'address'=>'elm',
            'status'=>'verified',
            'created_at'=>new \DateTime(date("Y/m/d")),
            'updated_at'=>new \DateTime(date("Y/m/d")),
        ]);

        \App\User::create([
            'name' => "Kenji",
            'first_name'=>'Kenji',
            'last_name'=>'Kurosawa',
            'designation'=>'Mr',
            'email' => "user@user.com",
            'password' => bcrypt('123456'),
            'dob'=>'1998-09-09',
            'type'=>'borrower',
            'contact'=>'12345',
            'address'=>'elm',
            'status'=>'verified',
            'created_at'=>new \DateTime(date("Y/m/d")),
            'updated_at'=>new \DateTime(date("Y/m/d")),
        ]);
    }
}
