<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        Model::unguard();
        $this->call('PoolSeeder');
        $this->call('CategorySeeder');
        $this->call('UserSeeder');
        $this->call('EntranceSeeder');
        $this->call('EntranceTypeSeeder');
        $this->call('EntranceRateSeeder');
        $this->call('DiscountSeeder');
        Model::reguard();
    }
}
