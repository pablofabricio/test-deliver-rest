<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Race extends Model
{
    public $timestamps = false;
    protected $table = 'race';

    protected $fillable = [
        'date',
        'id_race_race_types'
    ];
}
