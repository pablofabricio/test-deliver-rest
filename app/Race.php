<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Race extends Model
{
    public $timestamps = false;
    protected $table = 'race';

    protected $fillable = [
        'id_proof_types',
        'date'
    ];
}
