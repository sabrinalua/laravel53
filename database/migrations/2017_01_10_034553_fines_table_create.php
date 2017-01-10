<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FinesTableCreate extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fines', function (Blueprint $table) {
            $table->increments('id');
            $table->string('comment')->nullable();
            $table->string('log_id')->nullable();
            $table->string('book_id')->nullable();
            $table->string('user_id')->nullable();
            $table->string('logged_by')->nullable();
            $table->enum('type', ['return','lost'])->default('return');
            $table->timestamps();
            $table->integer('total_fines')->size(4)->default(2);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('fines');
    }
}
