<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBlogTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blogs', function (Blueprint $table) {
            $table->increments('id');
            // 标题
            $table->string('title',64);
            // 类型  文章  视频  小说  介绍
            $table->integer('type')->unsigned();
            // 关键字 标签  用作seo 另外开一张表
            // $table->string('keywords',64);
            // 简介 如果是视频此字段是url
            $table->string('introduction');
            // 将内容存进另外一张表
            // $table->text('content');
            // 阅读数
            $table->integer('amount');
            // 作者 关联user_id
            $table->integer('author')->unsigned();
            // 关联内容
            $table->integer('cid')->unsigned();
            // 是否原创 0是原创 1是转载
            $table->boolean('iszz',1)->default(0);
            // 发布状态 0是草稿, 1是发布... 9垃圾箱
            $table->integer('statu')->default(0);
            // 关联展示图片url
            $table->string('imgurl',200);
            // 关联作者用户
            $table->foreign('author')->references('id')->on('users');
            // 关联内容
            $table->foreign('cid')->references('id')->on('blog_content');
            // 关联类型
            $table->foreign('type')->references('id')->on('dictionaries');
            // 时间戳 更新与创建
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
        Schema::dropIfExists('blogs');
    }
}
