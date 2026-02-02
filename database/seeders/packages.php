<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class packages extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('packages')->insert([
            [
                'p_name' => 'P_1',
                'amount' => '111',
                'daily_ear_per' => '0.267',
                'monthly_ear_per' => '8',
            ],
            [
                'p_name' => 'P_2',
                'amount' => '555',
                'daily_ear_per' => '0.267',
                'monthly_ear_per' => '8',
            ],
            [
                'p_name' => 'P_3',
                'amount' => '1222',
                'daily_ear_per' => '0.3',
                'monthly_ear_per' => '9',
            ],
            [
                'p_name' => 'P_4',
                'amount' => '2888',
                'daily_ear_per' => '0.333',
                'monthly_ear_per' => '10',
            ],
            [
                'p_name' => 'P_5',
                'amount' => '5666',
                'daily_ear_per' => '0.367',
                'monthly_ear_per' => '11',
            ]
        ]);
    }
}
