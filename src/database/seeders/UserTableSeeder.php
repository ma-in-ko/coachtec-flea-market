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
            'name' => 'Sample',
            'email' => 'sample@email.com',
            'password' => Hash::make('123456789'),
            'email_verified_at' => now(),
            'created_at' => now(),
            'updated_at' => now(),
        ];
        DB::table('users')->insert($user);
    }
}