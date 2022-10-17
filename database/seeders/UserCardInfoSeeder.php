<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserCardInfoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('user_card_infos')->insert([
            [
                'card_number' =>    '3545466',
                'user_id' =>   1,
                'balance' =>   200,
                'pin_no' =>   123,
                'status' =>  1,
            ], [
                'card_number' =>    '3545460',
                'user_id' =>   1,
                'balance' =>   300,
                'pin_no' =>   123,
                'status' =>  1,
            ]
        ]);
    }
}
