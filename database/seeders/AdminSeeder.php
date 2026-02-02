<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('admins')->insert([
            [
                'name' => 'Admin User',
                'email' => 'Itsrathe106@gmail.com',
                'password' => Hash::make('Ashu@9211'), // Make sure to hash the password
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // You can add more admin records here if needed
        ]);
    }
}
