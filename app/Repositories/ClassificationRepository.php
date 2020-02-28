<?php 

namespace App\Repositories;

use App\RunnerRace;
use App\Repositories\ClassificationRepository;

class ClassificationRepository
{
    protected $modelClass = RunnerRace::class;

    public function getOverall() 
    {
        // separating by age
        $age = $this->modelClass
                    ::join('runner', 'runner_race.id_runner', '=', 'runner.id')
                    ->where('runner.id', 1)
                    ->get();
        return $age;


        // calculating the times

        //getting the classification order
    }

    public function getByAge()
    {
        return $this->modelClass::find($id);
    }
}