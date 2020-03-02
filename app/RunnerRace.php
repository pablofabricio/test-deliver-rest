<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RunnerRace extends Model
{
    public $timestamps = false;
    protected $table = 'runner_race';

    protected $fillable = [
        'id_runner',
        'id_race',
        'initial_time',
        'final_time',
        'race_time'
    ];
}
