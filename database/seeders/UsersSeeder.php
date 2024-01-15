<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

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
            'role' => 'super_admin'
        ]);
        DB::table('users')->insert([
            'name' => "Test User",
            'email' => "user@gmail.com",
            'password' => Hash::make('12345678'),
            'role' => 'user'
        ]);
        DB::table('users')->insert([
            'name' => "Test Manager",
            'email' => "manager@gmail.com",
            'password' => Hash::make('12345678'),
            'role' => 'manager'
        ]);
    }
}
