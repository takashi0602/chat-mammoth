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
        Schema::create('posts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('user_id')->default('anonymous');
            $table->string('screen_name')->default('Anonymous');
            $table->string('room_id');
            $table->text('comment')->nullable();
            $table->boolean('markdown')->default(false);
            $table->text('image')->nullable();
            $table->unsignedInteger('gif')->nullable();
            $table->text('draw')->nullable();
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
        Schema::dropIfExists('posts');
    }
}
