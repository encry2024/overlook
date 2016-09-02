<?php

use Illuminate\Database\Seeder;

class EntranceTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('entrance_type')->insert(
            array(
                array(
                    'entrance_id'   => 1,
                    'name'          => 'Day Time',
                    'created_at'    => date('Y-m-d H:i:s'),
                    'updated_at'    => date('Y-m-d H:i:s')
                ),
                array(
                    'entrance_id'   => 1,
                    'name'          => 'Night Time',
                    'created_at'    => date('Y-m-d H:i:s'),
                    'updated_at'    => date('Y-m-d H:i:s')
                ),
                array(
                    'entrance_id'   => 1,
                    'name'          => 'Whole Day',
                    'created_at'    => date('Y-m-d H:i:s'),
                    'updated_at'    => date('Y-m-d H:i:s')
                ),
                array(
                    'entrance_id'   => 2,
                    'name'          => 'Swimming Package',
                    'created_at'    => date('Y-m-d H:i:s'),
                    'updated_at'    => date('Y-m-d H:i:s')
                )
            )
        );
    }
}
