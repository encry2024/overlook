<?php

use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert(
            array(
                array(
                    'name'          => 'Standard',
                    'file_location' => '/pictures/rooms/standard.jpg',
                    'min_capacity'  => '0',
                    'max_capacity'  => 2,
                    'price'         => 1300,
                    'description'   => '',
                    'created_at'    => date('Y-m-d h:i:s'),
                    'updated_at'    => date('Y-m-d h:i:s')
                ),

                array(
                    'name'          => 'Dhalia',
                    'file_location' => '/pictures/rooms/dorm.jpg',
                    'min_capacity'  => '0',
                    'max_capacity'  => 18,
                    'price'         => 5500,
                    'description'   => '',
                    'created_at'    => date('Y-m-d h:i:s'),
                    'updated_at'    => date('Y-m-d h:i:s')
                ),

                array(
                    'name'          => 'Executive',
                    'file_location' => '/pictures/rooms/executive.jpg',
                    'min_capacity'  => 8,
                    'max_capacity'  => 10,
                    'price'         => 4000,
                    'description'   => '',
                    'created_at'    => date('Y-m-d h:i:s'),
                    'updated_at'    => date('Y-m-d h:i:s')
                ),

                array(
                    'name'          => 'Condo Suite',
                    'file_location' => '/pictures/rooms/condosuite.jpg',
                    'min_capacity'  => 8,
                    'max_capacity'  => 10,
                    'price'         => 4500,
                    'description'   => '',
                    'created_at'    => date('Y-m-d h:i:s'),
                    'updated_at'    => date('Y-m-d h:i:s')
                ),

                array(
                    'name'          => 'Azalea',
                    'file_location' => '/pictures/rooms/azalea.jpg',
                    'min_capacity'  => 9,
                    'max_capacity'  => 10,
                    'price'         => 4500,
                    'description'   => '',
                    'created_at'    => date('Y-m-d h:i:s'),
                    'updated_at'    => date('Y-m-d h:i:s')
                )
            )
        );
    }
}
