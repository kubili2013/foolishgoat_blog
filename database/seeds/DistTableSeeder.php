<?php

use Illuminate\Database\Seeder;

class DistTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('dictionaries')->insert([
            'word' => '根节点',
            'intruduction' => '数据字典树叶,从此开始。',
            'code' => 'root',
            'parent_id' => 0,
        ]);
        $root = DB::table('dictionaries')->where('code','root')->first();
        DB::table('dictionaries')->insert([
            'word' => '分类',
            'intruduction' => '博客分类',
            'code' => 'type',
            'parent_id' => $root->id,
        ]);
        DB::table('dictionaries')->insert([
            'word' => '标签',
            'intruduction' => '博客文章的标签。',
            'code' => 'tag',
            'parent_id' => $root->id,
        ]);
        $type = DB::table('dictionaries')->where('code','type')->first();
        DB::table('dictionaries')->insert([
            'word' => '视频',
            'intruduction' => '博客分类',
            'code' => 'video',
            'parent_id' => $type->id,
        ]);
        DB::table('dictionaries')->insert([
            'word' => '小说',
            'intruduction' => '博客分类',
            'code' => 'novel',
            'parent_id' => $type->id,
        ]);
        DB::table('dictionaries')->insert([
            'word' => '下载',
            'intruduction' => '博客分类',
            'code' => 'download',
            'parent_id' => $type->id,
        ]);
        DB::table('dictionaries')->insert([
            'word' => '技术',
            'intruduction' => '博客分类',
            'code' => 'technology',
            'parent_id' => $type->id,
        ]);
        DB::table('dictionaries')->insert([
            'word' => '关于我',
            'intruduction' => '博客分类',
            'code' => 'about',
            'parent_id' => $type->id,
        ]);
    }
}
