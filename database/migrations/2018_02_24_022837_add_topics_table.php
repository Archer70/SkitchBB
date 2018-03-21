<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTopicsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('topics', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('board_id')->unsigned();
            $table->integer('first_post_id')->unsigned()->nullable();
            $table->integer('last_post_id')->unsigned()->nullable();
            $table->integer('user_id')->unsigned();
            $table->string('title');
            $table->boolean('sticky')->default(0);
            $table->boolean('locked')->default(0);
            $table->integer('post_count')->unsigned()->default(1);
            $table->integer('view_count')->unsigned()->default(0);
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('board_id')->references('id')->on('boards');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('topics');
    }
}
