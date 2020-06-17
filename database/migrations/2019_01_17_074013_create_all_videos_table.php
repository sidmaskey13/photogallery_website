<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAllVideosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('all_videos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('video_id');
            $table->text('video_file');
            $table->timestamps();
        });
        Schema::table('videos', function($table) {
            $table->dropColumn(['video']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('all_videos');
    }
}
