<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Advertisment extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('advertisements', function (Blueprint $table) {
            $table->increments('id');
            $table->string('ad_source', 100);
            $table->integer('video_id')->unsigned();
            $table->string('ad_type', 100);
            $table->integer('ad_provider');
            $table->boolean('ad_scheduled');
            $table->boolean('ad_companion');
            $table->boolean('ad_autoplay');
            $table->string('ad_divid');
            $table->integer('ad_width');
            $table->integer('ad_height');
            $table->timestamps();
        });
        Schema::table('advertisements', function ($table) {
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
        //
    }
}
