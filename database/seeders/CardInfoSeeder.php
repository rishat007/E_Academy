<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CardInfoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('card_information')->insert([
            [
                'card_number' =>    '3545466',
                'card_type' =>    'Visa',
                'is_sale' =>   0,
            ], [
                'card_number' =>    '3545460',
                'card_type' =>    'Visa',
                'is_sale' =>   0,
            ]
        ]);
    }
}
