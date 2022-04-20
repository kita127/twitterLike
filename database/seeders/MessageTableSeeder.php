<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class MessageTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // テーブルのクリア
        DB::table('messages')->truncate();

        DB::table('messages')->insert([
            'user_id' => 0,
            'message' => 'シードメッセージ1',
            'favorite' => 0,
            'type' => 'tweet',
            'message_id' => -1,
            'norify_id' => -1,
            'image' => '',
        ]);
    }
}
