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
            'dob'=>'2001-09-09',
            'type'=>'borrower',
            'contact'=>'12345',
            'address'=>'elm',
            'status'=>'verified',
            'created_at'=>new \DateTime(date("Y/m/d")),
            'updated_at'=>new \DateTime(date("Y/m/d")),
        ]);

        \App\Books::create([
            'title'=>'The Velvet Rabbit',
            'isbn'=>'0380002558',
            'author'=>'Margery Williams',
            'location' =>'FICT01',
            'added_by' => '1',
            'publisher'=>'Simon Pulse',
            'publish_year'=>'1992',
            'description'=>'A stuffed rabbit sewn from velveteen is given as a Christmas present to a small boy.'
            ]);

        \App\Books::create([
            'title'=>'The Princess Diaries',
            'isbn'=>'0-380-81402-1',
            'author'=>'Meg Cabot',
            'location' =>'FICT02',
            'publisher'=>'Simon Pulse',
            'added_by' => '1',
            'publish_year'=>'2000',
            'description'=>'The Princess Diaries is a series of epistolary young adult novels written by Meg Cabot, and is also the title of the first volume, published in 2000.'
            ]);

        \App\Books::create([
            'title'=>'The Princess Diaries 2',
            'isbn'=>'0-380-81402-2',
            'author'=>'Meg Cabot',
            'location' =>'FICT02',
            'publisher'=>'Simon Pulse',
            'added_by' => '1',
            'publish_year'=>'2001',
            'description'=>'The Princess Diaries is a series of epistolary young adult novels written by Meg Cabot, and is also the title of the first volume, published in 2000.'
            ]);

        \App\Books::create([
            'title'=>'The Princess Diaries 3',
            'isbn'=>'0-380-81402-3',
            'author'=>'Meg Cabot',
            'location' =>'FICT02',
            'publisher'=>'Simon Pulse',
            'added_by' => '1',
            'publish_year'=>'2003',
            'description'=>'The Princess Diaries is a series of epistolary young adult novels written by Meg Cabot, and is also the title of the first volume, published in 2000.'
            ]);

        \App\Books::create([
            'title'=>'Evolutionary Biology',
            'isbn'=>'0-201-15890-6',
            'author'=>'Eli C. Minkoff',
            'location' =>'EDU03',
            'publisher'=>'Fisherman\'s Friend',
            'publish_year'=>'1985',
            'added_by' => '1',
            'description'=>'The textbook Evolutionary Biology was written and published in 1983 during which Minkoff was the head of the Biology department at Bates College. The book is written in a format to which it could be used in an evolutionary biology 101 course. The book contains over 25 chapters, for example, "The Origin and Early Evolution of Life."'
            ]);

        \App\Section::create([
            'section_code'=>'FICT01',
            'section_name'=>'Fiction: sci-fi/fantasy']);

        \App\Section::create([
            'section_code'=>'FICT03',
            'section_name'=>'Fiction: satire']);

        \App\Section::create([
            'section_code'=>'FICT02',
            'section_name'=>'Fiction: Drama']);
       
        \App\Section::create([
            'section_code'=>'FICT02',
            'section_name'=>'Fiction: Romance']);

        \App\Section::create([
            'section_code'=>'FICT03',
            'section_name'=>'Fiction: Mystery']);

        \App\Section::create([
            'section_code'=>'EDU01',
            'section_name'=>'Education: Self-help']);

        \App\Section::create([
            'section_code'=>'EDU02',
            'section_name'=>'Education: textBooks']);

        \App\Section::create([
            'section_code'=>'OTH',
            'section_name'=>'Others']);
    }
}
