<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class FollowTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        // テーブルのクリア
        DB::table('follows')->truncate();

        DB::table('follows')->insert([
            'user_id' => -1,
            'following_user_id' => -1,
        ]);
    }
}
