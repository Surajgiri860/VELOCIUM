<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Level extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('levels')->insert([
            [
                'level' => '1',
                'level_name' => 'L_1',
                'level_per' => '2',
                'direct' => '3',
            ],
            [
                'level' => '2',
                'level_name' => 'L_2',
                'level_per' => '1',
                'direct' => '3',
            ],
            [
                'level' => '3',
                'level_name' => 'L_3',
                'level_per' => '1',
                'direct' => '3',
            ],
            [
                'level' => '4',
                'level_name' => 'L_4',
                'level_per' => '0.75',
                'direct' => '4',
            ],
            [
                'level' => '5',
                'level_name' => 'L_5',
                'level_per' => '0.40',
                'direct' => '5',
            ],
            [
                'level' => '6',
                'level_name' => 'L_6',
                'level_per' => '0.20',
                'direct' => '6',
            ],
            [
                'level' => '7',
                'level_name' => 'L_7',
                'level_per' => '0.20',
                'direct' => '7',
            ],
            [
                'level' => '8',
                'level_name' => 'L_8',
                'level_per' => '0.20',
                'direct' => '8',
            ],
            [
                'level' => '9',
                'level_name' => 'L_9',
                'level_per' => '0.20',
                'direct' => '9',
            ],
            [
                'level' => '10',
                'level_name' => 'L_10',
                'level_per' => '0.20',
                'direct' => '10',
            ],
            [
                'level' => '11',
                'level_name' => 'L_11',
                'level_per' => '0.10',
                'direct' => '11',
            ],
            [
                'level' => '12',
                'level_name' => 'L_12',
                'level_per' => '0.10',
                'direct' => '12',
            ],
            [
                'level' => '13',
                'level_name' => 'L_13',
                'level_per' => '0.10',
                'direct' => '13',
            ],
            [
                'level' => '14',
                'level_name' => 'L_14',
                'level_per' => '0.10',
                'direct' => '14',
            ],
            [
                'level' => '15',
                'level_name' => 'L_15',
                'level_per' => '0.10',
                'direct' => '15',
            ],
            [
                'level' => '16',
                'level_name' => 'L_16',
                'level_per' => '0.05',
                'direct' => '16',
            ],
            [
                'level' => '17',
                'level_name' => 'L_17',
                'level_per' => '0.05',
                'direct' => '17',
            ],
            [
                'level' => '18',
                'level_name' => 'L_18',
                'level_per' => '0.05',
                'direct' => '18',
            ],
            [
                'level' => '19',
                'level_name' => 'L_19',
                'level_per' => '0.05',
                'direct' => '19',
            ],
            [
                'level' => '20',
                'level_name' => 'L_20',
                'level_per' => '0.05',
                'direct' => '20',
            ]
        ]);
    }
}
