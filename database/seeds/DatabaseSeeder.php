<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RaceTypesTableSeeder::class);
        $this->call(RaceTableSeeder::class);
        $this->call(AgeTableSeeder::class);
        $this->call(RunnerTableSeeder::class);
        $this->call(RunnerRaceTableSeeder::class);
    }
}
