<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration{

    public function up(){
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->text('post');
            $table->bigInteger('user_id')->unsigned();
            $table->bigInteger('topic_id')->unsigned();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('restrict');
            $table->foreign('topic_id')->references('id')->on('topics')->onUpdate('cascade')->onDelete('restrict');
        });
    }

    public function down()
    {
        Schema::dropIfExists('posts');
    }
}
