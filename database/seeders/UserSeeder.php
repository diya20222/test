<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Admin',
            'email' =>'admin@admin.com',
            'mobile' => '1111111111', 
            'password' => Hash::make('Admin@123'),
            'image' => 'B4S7YKJOtp1wMM4YmaJfZVkmWhgFVdXyZ5qFV73Z.png',
        ]);
    }
}
