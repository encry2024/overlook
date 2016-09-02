<?php

use Illuminate\Database\Seeder;

class EntranceRateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('entrance_rate')->insert(
            array(
                array(
                    'entrance_type_id'  => 1,
                    'name'              => 'Adult',
                    'price'             => 130.00,
                    'created_at'        => date('Y-m-d H:i:s'),
                    'updated_at'        => date('Y-m-d H:i:s')
                ),
                array(
                    'entrance_type_id'  => 1,
                    'name'              => 'Child',
                    'price'             => 120.00,
                    'created_at'        => date('Y-m-d H:i:s'),
                    'updated_at'        => date('Y-m-d H:i:s')
                ),
                array(
                    'entrance_type_id'  => 2,
                    'name'              => 'Adult',
                    'price'             => 150.00,
                    'created_at'        => date('Y-m-d H:i:s'),
                    'updated_at'        => date('Y-m-d H:i:s')
                ),
                array(
                    'entrance_type_id'  => 2,
                    'name'              => 'Child',
                    'price'             => 100.00,
                    'created_at'        => date('Y-m-d H:i:s'),
                    'updated_at'        => date('Y-m-d H:i:s')
                ),
                array(
                    'entrance_type_id'  => 3,
                    'name'              => 'Adult',
                    'price'             => 250.00,
                    'created_at'        => date('Y-m-d H:i:s'),
                    'updated_at'        => date('Y-m-d H:i:s')
                ),
                array(
                    'entrance_type_id'  => 3,
                    'name'              => 'Child',
                    'price'             => 200.00,
                    'created_at'        => date('Y-m-d H:i:s'),
                    'updated_at'        => date('Y-m-d H:i:s')
                ),
                array(
                    'entrance_type_id'  => 4,
                    'name'              => '70-100 pax',
                    'price'             => 43.33,
                    'created_at'        => date('Y-m-d H:i:s'),
                    'updated_at'        => date('Y-m-d H:i:s')
                )
            )
        );
    }
}
