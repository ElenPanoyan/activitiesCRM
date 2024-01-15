<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'name' => "Super Admin",
            'email' => "super_admin@gmail.com",
            'password' => Hash::make('12345678'),
            'role' => 'super_admin',
            'api_token' => hash('sha256', Str::random(60))
        ]);
        DB::table('users')->insert([
            'name' => "Test User",
            'email' => "user@gmail.com",
            'password' => Hash::make('12345678'),
            'role' => 'user',
            'api_token' => hash('sha256', Str::random(60))
        ]);
        DB::table('users')->insert([
            'name' => "Test Manager",
            'email' => "manager@gmail.com",
            'password' => Hash::make('12345678'),
            'role' => 'manager',
            'api_token' => hash('sha256', Str::random(60))
        ]);
    }
}
