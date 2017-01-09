<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBookTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('books', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('isbn');
            $table->string('author');
            $table->string('publisher')->default('unknown');
            $table->integer('publish_year')->size(4)->nullable();
            $table->string('location');
            $table->string('added_by');
            $table->text('description')->nullable();
            $table->enum('status', ['available', 'borrowed', 'lost', 'deleted'])->default('available');
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('books');
    }
}
