<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 管理者ユーザー作成
        DB::table('users')->insert([
            [
                'name' => '管理者',
                'email' => 'admin@email.com',
                'email_verified_at' => null,
                'password' => Hash::make('kanrisha2000'),
                'two_factor_secret' => null,
                'two_factor_recovery_codes' => null,
                'two_factor_confirmed_at' => null,
                'remember_token' => null,
                'role' => 'admin',
            ],
            [
                'name' => 'ゆうや',
                'email' => 'yuya@email.com',
                'email_verified_at' => null,
                'password' => Hash::make('yuya2002'),
                'two_factor_secret' => null,
                'two_factor_recovery_codes' => null,
                'two_factor_confirmed_at' => null,
                'remember_token' => null,
                'role' => 'admin',
            ],
            [
                'name' => 'しんたろう',
                'email' => 'shintaro@email.com',
                'email_verified_at' => null,
                'password' => Hash::make('shintaro1998'),
                'two_factor_secret' => null,
                'two_factor_recovery_codes' => null,
                'two_factor_confirmed_at' => null,
                'remember_token' => null,
                'role' => 'admin',
            ],
        ]);
    }
}
