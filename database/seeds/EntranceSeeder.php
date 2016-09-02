<?php

use Illuminate\Database\Seeder;

class EntranceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('entrances')->insert(
            array(
                array(
                    'name'          => 'Non Package',
                    'time_limit'    => 11,
                    'created_at'    => date('Y-m-d h:i:s'),
                    'updated_at'    => date('Y-m-d h:i:s')
                ),
                array(
                    'name'          => 'Package',
                    'time_limit'    => 11,
                    'created_at'    => date('Y-m-d h:i:s'),
                    'updated_at'    => date('Y-m-d h:i:s')
                )
            )
        );
    }
}
