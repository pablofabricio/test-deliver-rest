<?php

use Illuminate\Database\Seeder;

class AgeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $ages= [
            [
                'initial_age' => 18,
                'final_age' => 25,
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
        DB::table('age')->insert($ages);
    }
}
