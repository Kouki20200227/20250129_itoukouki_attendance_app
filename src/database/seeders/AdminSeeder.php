<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
                // 管理者ユーザー作成
        DB::table('admins')->insert([
            [
                'name' => '管理者',
                'email' => 'admin@email.com',
                'password' => Hash::make('kanrisha2000'),
            ],
            [
                'name' => 'ゆうや',
                'email' => 'yuya@email.com',
                'password' => Hash::make('yuya2002'),
            ],
            [
                'name' => 'しんたろう',
                'email' => 'shintaro@email.com',
                'password' => Hash::make('shintaro1998'),
            ],
        ]);
    }
}
