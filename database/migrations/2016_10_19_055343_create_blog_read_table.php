<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBlogReadTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blog_read', function (Blueprint $table) {
            $table->increments('id');
            $table->string('ip',32);
            $table->integer('userid')->unsigned();
            $table->integer('blogid')->unsigned();
            $table->foreign('userid')->references('id')->on('users');
            $table->foreign('blogid')->references('id')->on('blogs');
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
        Schema::dropIfExists('blog_read');
    }
}
