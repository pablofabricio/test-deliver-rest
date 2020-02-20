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
                '' => 25,
            ],
            [
                'initial_age' => 25,
                'final_age' => 35,
            ],
            [
                'initial_age' => 35,
                'final_age' => 45,
            ],
            [
                'initial_age' => 45,
                'final_age' => 55,
            ],
            [
                'initial_age' => 55,
                'final_age' => 150,
            ]
        ];
        DB::table('race')->insert($races);
    }
}
