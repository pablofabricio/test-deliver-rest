<?php 

namespace App\Repositories;

use App\Age;

class AgeRepository implements RepositoryInterface 
{
    public function findAll() 
    {
        return Age::all();
    }
}