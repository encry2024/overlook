<?php

use Illuminate\Database\Seeder;

class PoolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('pools')->insert(
            array(
                array(
                    'name'          => 'Upper Pool Cottage',
                    'file_location' => '',
                    'price'         => 43.33,
                    'min_capacity'  => '70',
                    'max_capacity'  => '100',
                    'created_at'    => date('Y-m-d H:i:s'),
                    'updated_at'    => date('Y-m-d H:i:s')
                ),
                array(
                    'name'          => 'Lower Pool Cottage',
                    'file_location' => '',
                    'price'         => 20,
                    'min_capacity'  => '20',
                    'max_capacity'  => '30',
                    'created_at'    => date('Y-m-d H:i:s'),
                    'updated_at'    => date('Y-m-d H:i:s')
                ),
                array(
                    'name'          => 'Slide Pool Cottage',
                    'file_location' => '',
                    'price'         => 10,
                    'min_capacity'  => '20',
                    'max_capacity'  => '30',
                    'created_at'    => date('Y-m-d H:i:s'),
                    'updated_at'    => date('Y-m-d H:i:s')
                ),
                array(
                    'name'          => 'Open Cottage',
                    'file_location' => '',
                    'price'         => 10,
                    'min_capacity'  => '10',
                    'max_capacity'  => '20',
                    'created_at'    => date('Y-m-d H:i:s'),
                    'updated_at'    => date('Y-m-d H:i:s')
                )
            )
        );
    }
}
