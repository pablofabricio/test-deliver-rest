<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RaceTypes extends Model
{
    public $timestamps = false;
    protected $table = 'race_types';

    protected $fillable = [
        'name'
    ];
}
