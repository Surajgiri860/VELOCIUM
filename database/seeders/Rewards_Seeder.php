<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Rewards_Seeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('rewards')->insert([
            [
                'name' => 'Rewards 1',
                'r_name' => 'R_1',
                'team_business' => '10000',
                'reward' => '200',
            ],

            [
                'name' => 'Rewards 1',
                'r_name' => 'R_2',
                'team_business' => '25000',
                'reward' => '500',
            ],
            [
                'r_name' => 'R_3',
                'team_business' => '60000',
                'reward' => '1200',
            ],
            [
                'r_name' => 'R_4',
                'team_business' => '125000',
                'reward' => '3000',
            ],
            [
                'r_name' => 'R_5',
                'team_business' => '300000',
                'reward' => '7500',
            ],
            [
                'r_name' => 'R_6',
                'team_business' => '600000',
                'reward' => '15000',
            ],
            [
                'r_name' => 'R_7',
                'team_business' => '1200000',
                'reward' => '30000',
            ],
            [
                'r_name' => 'R_8',
                'team_business' => '2500000',
                'reward' => '50000',
            ],
            [
                'r_name' => 'R_9',
                'team_business' => '5000000',
                'reward' => '100000',
            ]
        ]);
    }
}
