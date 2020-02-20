<?php

use Illuminate\Database\Seeder;

class RaceTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $racesypes = [
            [
                'name' => "3Km",
            ],
            [
                'name' => "5Km",
            ],
            [
                'name' => "10Km",
            ],
            [
                'name' => "21Km",
            ],
            [
                'name' => "42Km",
            ]
        ];
        DB::table('race_types')->insert($racesypes);
    }
}
