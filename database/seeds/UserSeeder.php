<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert(
            array(
                array(
                    'name'          => 'Test Admin',
                    'email'         => 'test_admin@yahoo.com',
                    'password'      => bcrypt('admin123'),
                    'role'          => 'admin',
                    'created_at'    => date('Y-m-d h:i:s'),
                    'updated_at'    => date('Y-m-d h:i:s')
                )
            )
        );
    }
}
