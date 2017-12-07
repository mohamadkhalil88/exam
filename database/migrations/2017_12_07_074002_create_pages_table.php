<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable("pages")) {
            Schema::create('pages', function (Blueprint $table) {
                $table->increments('id');
                $table->string("page_link");
                $table->string("page_lang");
                $table->string("page_location");
                $table->text("page_location_name");
                $table->string("page_category")->nullable();
                $table->string("page_area");
                $table->text("page_freq");
                $table->dateTime("page_next_time");
                $table->dateTime("page_last_time");
                $table->integer("domain_id")->unsigned();
                $table->foreign('domain_id')->references('id')->on('domains');
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
        Schema::dropIfExists('pages');
    }
}
