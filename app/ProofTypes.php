<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProofTypes extends Model
{
    public $timestamps = false;
    protected $table = 'proof_types';

    protected $fillable = [
        'name'
    ];
}
