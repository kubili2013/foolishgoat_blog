<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDictionary extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dictionaries', function (Blueprint $table) {
            $table->increments('id');
            // 数据字典
            $table->string('word',48);
            // 数据字典
            $table->string('code',12);
            // 介绍
            $table->string('intruduction');
            // 父级id
            $table->integer('parent_id')->index();
            // 创建时间
            $table->timestamps();
        });
        //添加基础数据

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dictionaries');
    }
}
