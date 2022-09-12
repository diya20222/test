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
            $table->id();
            $table->string('video_link');

            $table->unsignedBigInteger('category_id');
            $table->foreign('category_id')->references('id')->on('categories');
            
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            
            $table->string('video_title');
            $table->string('video');
            $table->string('thumbnail');
            $table->string('tag');
            $table->text('slug');
            $table->text('description');
            $table->date('published_at');
            $table->timestamps();
            $table->softDeletes();
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
