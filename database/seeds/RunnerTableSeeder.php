<?php

use Illuminate\Database\Seeder;

class RunnerTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $runner = [
            [
                'name' => "Pablo",
                'birth_date' => "2000-01-07",
                'CPF' => "12929382",
            ],
            [
                'name' => "miculos",
                'birth_date' => "2001-01-07",
                'CPF' => "12929322",
            ],
            [
                'name' => "Bruno",
                'birth_date' => "2010-01-07",
                'CPF' => "12234442",
            ],
            [
                'name' => "marcos",
                'birth_date' => "1970-01-07",
                'CPF' => "1232332",
            ],
            [
                'name' => "marquito",
                'birth_date' => "1980-01-07",
                'CPF' => "4434333",
            ],
            [
                'name' => "marquito limão",
                'birth_date' => "1990-01-07",
                'CPF' => "4434333",
            ],
            [
                'name' => "marquito miculos",
                'birth_date' => "1995-01-07",
                'CPF' => "4434333",
            ],
            [
                'name' => "marquito dai prá",
                'birth_date' => "1985-01-07",
                'CPF' => "44345",
            ],
            [
                'name' => "marquito saraiva",
                'birth_date' => "1980-01-07",
                'CPF' => "4434333",
            ],
            [
                'name' => "marquito beach",
                'birth_date' => "1940-01-07",
                'CPF' => "4434333",
            ]
        ];
        DB::table('runner')->insert($runner);
    }
}
