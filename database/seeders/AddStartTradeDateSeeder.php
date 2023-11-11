<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AddStartTradeDateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('data_rows')->where(['data_type_id' => 3, 'field' => 'start_trade_date'])->delete();

        \DB::table('data_rows')->insert(array(
            0 =>
            array(
                'data_type_id' => 3,
                'field' => 'start_trade_date',
                'type' => 'timestamp',
                'display_name' => 'Start Trade Date',
                'required' => 0,
                'browse' => 1,
                'read' => 1,
                'edit' => 1,
                'add' => 1,
                'delete' => 1,
                'details' => NULL,
                'order' => 10,
            ),
        ));
    }
}
