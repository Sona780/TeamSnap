<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(GameSeeder::class);
        $this->call(TimeZoneSeeder::class);
        $this->call(CountrySeeder::class);
    }
}
