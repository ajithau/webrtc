<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class VideoAdbreak extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('video_adbreaks', function (Blueprint $table) {
            $table->increments('id');
            $table->float('break');
            $table->integer('ad_id')->unsigned();
            $table->timestamps();            
        });
        Schema::table('video_adbreaks', function ($table) {
            $table->foreign('ad_id')
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
