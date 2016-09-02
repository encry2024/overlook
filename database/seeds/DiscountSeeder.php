<?php

use Illuminate\Database\Seeder;

class DiscountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('discounts')->insert(
            array(
                array(
                    'name'          => 'No discount',
                    'deduction'     => 0,
                    'created_at'    => date('Y-m-d h:i:s'),
                    'updated_at'    => date('Y-m-d h:i:s')
                ),
                array(
                    'name'          => '5% discount',
                    'deduction'     => 0.05,
                    'created_at'    => date('Y-m-d h:i:s'),
                    'updated_at'    => date('Y-m-d h:i:s')
                ),
                array(
                    'name'          => '6% discount',
                    'deduction'     => 0.06,
                    'created_at'    => date('Y-m-d h:i:s'),
                    'updated_at'    => date('Y-m-d h:i:s')
                ),
                array(
                    'name'          => '7% discount',
                    'deduction'     => 0.07,
                    'created_at'    => date('Y-m-d h:i:s'),
                    'updated_at'    => date('Y-m-d h:i:s')
                ),
                array(
                    'name'          => '8% discount',
                    'deduction'     => 0.08,
                    'created_at'    => date('Y-m-d h:i:s'),
                    'updated_at'    => date('Y-m-d h:i:s')
                ),
                array(
                    'name'          => '9% discount',
                    'deduction'     => 0.09,
                    'created_at'    => date('Y-m-d h:i:s'),
                    'updated_at'    => date('Y-m-d h:i:s')
                ),
                array(
                    'name'          => '10% discount',
                    'deduction'     => 0.10,
                    'created_at'    => date('Y-m-d h:i:s'),
                    'updated_at'    => date('Y-m-d h:i:s')
                )
            )
        );
    }
}
