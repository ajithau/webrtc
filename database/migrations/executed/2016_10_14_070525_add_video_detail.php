<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddVideoDetail extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('video_details', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('video_id')->unsigned();
            $table->string('title', 255);
            $table->time('duration');
            $table->string('meta_title', 255);
            $table->string('meta_description', 255);
            $table->text('description');
            $table->string('copy_right', 255);
            $table->string('author', 255);
            $table->boolean('autoplay');
            $table->string('embedded_code', 255);
            $table->timestamps();
        });
        Schema::table('video_details', function ($table) {
            $table->foreign('video_id')
                  ->references('id')->on('videos')
                  ->onDelete('cascade');
        });        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('video_details');
    }
}
