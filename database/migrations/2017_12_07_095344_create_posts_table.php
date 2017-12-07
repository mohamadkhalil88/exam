<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable("posts")) {
            Schema::create('posts', function (Blueprint $table) {
                $table->increments('id');
                $table->string("post_title", 1024);
                $table->string("post_image");
                $table->longText("post_body");
                $table->integer("page_id")->unsigned();
                $table->foreign('page_id')->references('id')->on('pages');
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
}