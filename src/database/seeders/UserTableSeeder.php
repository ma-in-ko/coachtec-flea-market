<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = [
            'name' => '出品者',
            'email' => 'seller@email.com',
            'password' => Hash::make('password'),
            'email_verified_at' => now(),
            'created_at' => now(),
            'updated_at' => now(),
        ];
        DB::table('users')->insert($user);

        $user = [
            'name' => '購入者',
            'email' => 'buyer@email.com',
            'password' =>Hash::make('password'),
            'email_verified_at' =>now(),
            'created_at' => now(),
            'updated_at' => now(),
        ];
        DB::table('users')->insert($user);
    }
}