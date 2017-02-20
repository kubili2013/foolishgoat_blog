<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKeywords extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('keywords', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('bid')->unsigned();
            $table->integer('did')->unsigned();
            // 数据字典与博客 - 关联类型 - 0 关键字关联,等
            $table->integer('type')->default(0);
            // 外键关联 博客id
            $table->foreign('bid')->references('id')->on('blogs');
            // 外键关联 数据字典id
            $table->foreign('did')->references('id')->on('dictionaries');
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
        Schema::dropIfExists('keywords');
    }
}
