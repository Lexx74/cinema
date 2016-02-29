<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMovieTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('movies', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title', 100);
            $table->integer('genre_id')->unsigned()->foreign('genre_id')->reference('id')->on('genres')->onDelete('cascade');
            $table->string('url_trailer', 255);
            $table->integer('length')->unsigned();
            $table->string('plot', 1000);
            $table->integer('year');
            $table->string('country', 50);
            $table->string('director', 50);
            $table->string('uri_poster', 255);
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
        Schema::drop('movies');
    }
}
