<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVideosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('videos', function (Blueprint $table) {
            $table->increments('id');            
            $table->string('video_id')->nullable();
			$table->string('videos_id')->nullable();
            $table->string('query')->nullable();
            $table->text('title')->nullable();
            $table->text('published')->nullable();
            $table->text('image')->nullable();
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
        Schema::dropIfExists('videos');
    }
}
