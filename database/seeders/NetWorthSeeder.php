<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class NetWorthSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $data = [
            [
                'net_worth_percentile' => '10',
                'net_worth' => '50000',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'net_worth_percentile' => '20',
                'net_worth' => '185000',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'net_worth_percentile' => '30',
                'net_worth' => '285000',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'net_worth_percentile' => '40',
                'net_worth' => '400000',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'net_worth_percentile' => '50',
                'net_worth' => '482000',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'net_worth_percentile' => '60',
                'net_worth' => '582000',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'net_worth_percentile' => '70',
                'net_worth' => '685000',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'net_worth_percentile' => '80',
                'net_worth' => '780000',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'net_worth_percentile' => '90',
                'net_worth' => '840000',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'net_worth_percentile' => '93',
                'net_worth' => '900000',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'net_worth_percentile' => '94',
                'net_worth' => '930000',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'net_worth_percentile' => '95',
                'net_worth' => '980000',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'net_worth_percentile' => '97.5',
                'net_worth' => '1500000',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'net_worth_percentile' => '99',
                'net_worth' => '9737000',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'net_worth_percentile' => '99.5',
                'net_worth' => '12800000',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'net_worth_percentile' => '99.6',
                'net_worth' => '14000000',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'net_worth_percentile' => '99.7',
                'net_worth' => '15000000',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'net_worth_percentile' => '99.8',
                'net_worth' => '20000000',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'net_worth_percentile' => '99.9',
                'net_worth' => '25000000',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'net_worth_percentile' => '99.97',
                'net_worth' => '30000000',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]
        ];
        DB::table('net_worth_rankings')->insert($data);
    }
}
