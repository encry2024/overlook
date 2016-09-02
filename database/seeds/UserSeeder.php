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
                'email'         => env('EMAIL'),
                'name'          => env('NAME'),
                'password'      => Hash::make(env('PASSWORD')),
                'role'          => env('TYPE'),
                'created_at'    => date('Y-m-d H:i:s'),
                'updated_at'    => date('Y-m-d H:i:s')
            )
        );
    }
}
