<?php

use Illuminate\Database\Seeder;

class RunnerRaceTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $runnerRace = [
            [
                'id_runner' => 1,
                'id_race' => 1,
                'initial_time' => "08:00:00",
                'final_time' => "10:10:00",
                'race_time' => "02:10:00",
            ],
            [
                'id_runner' => 7,
                'id_race' => 1,
                'initial_time' => "08:00:00",
                'final_time' => "10:12:00",
                'race_time' => "02:12:00",
            ],
            [
                'id_runner' => 3,
                'id_race' => 1,
                'initial_time' => "08:00:00",
                'final_time' => "10:11:00",
                'race_time' => "02:11:00",
            ],
            [
                'id_runner' => 4,
                'id_race' => 1,
                'initial_time' => "08:00:00",
                'final_time' => "10:15:00",
                'race_time' => "02:15:00",
            ],
            [
                'id_runner' => 5,
                'id_race' => 1,
                'initial_time' => "08:00:00",
                'final_time' => "10:16:00",
                'race_time' => "02:16:00",
            ],
        ];
        DB::table('runner_race')->insert($runnerRace);
    }
}
