<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Runner extends Model
{
    public $timestamps = false;
    protected $table = 'runner';

    protected $fillable = [
        'name',
        'CPF',
        'birth_date'
    ];
}
