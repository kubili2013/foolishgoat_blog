<?php

use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tag = DB::table('dictionaries')->where('code','tag')->first();
        DB::table('dictionaries')->insert([
            'word' => 'Java',
            'intruduction' => '关键词',
            'code' => 'java',
            'parent_id' => $tag->id,
        ]);
        DB::table('dictionaries')->insert([
            'word' => 'PHP',
            'intruduction' => '关键词',
            'code' => 'PHP',
            'parent_id' => $tag->id,
        ]);
        DB::table('dictionaries')->insert([
            'word' => 'Laravel',
            'intruduction' => '关键词',
            'code' => 'Laravel',
            'parent_id' => $tag->id,
        ]);
        DB::table('dictionaries')->insert([
            'word' => 'ionic',
            'intruduction' => '关键词',
            'code' => 'ionic',
            'parent_id' => $tag->id,
        ]);

    }
}
