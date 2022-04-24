<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
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
        DB::table('users')->truncate();

        /*
        $users = [
            [
                'name' => 'sato',
                'email' => 'sato@email',
                'password' => 'satosato',
            ],
            [
                'name' => 'suzuki',
                'email' => 'suzuki@email',
                'password' => 'suzukisuzuki',
            ],
        ];

        foreach ($users as $user) {
            \App\Models\User::create($user);
        }
        */
    }
}
