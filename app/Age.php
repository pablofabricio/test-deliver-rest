<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Age extends Model
{
    public $timestamps = false;
    protected $table = 'age';

    protected $fillable = [
        'initial_age',
        'final_age',
    ];
}
