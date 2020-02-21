<?php

use Illuminate\Database\Seeder;

class RaceTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $races= [
            [
                'date' => "2020-02-10",
                'id_race_type' => 1,
            ],
            [
                'date' => "2020-01-10",
                'id_race_type' => 2,
            ]
        ];
        DB::table('race')->insert($races);
    }
}
