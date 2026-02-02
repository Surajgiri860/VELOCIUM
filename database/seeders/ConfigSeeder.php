<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ConfigSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('config')->insert([
            [
                'admin_address' => '0x85569E73c9223CBE9c99DcF40bbA654BDEA5Ec60',
                'direct_sponser' => '3',
                'min_deposit' => '100',
                'min_wothdrawal' => '101',
                'admin_charge' => '10',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // You can add more admin records here if needed
        ]);
    }
}
