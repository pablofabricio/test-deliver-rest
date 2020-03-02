<?php 

namespace App\Repositories;

use App\RunnerRace;


class ClassificationRepository
{
    protected $modelClass = RunnerRace::class;

    public function getOverall() 
    {
        // GROUPING BY RACE AND ORDERING BY TIME DESC
        $data = $this->modelClass::orderBy('id_race', 'asc')
                                 ->orderBy('race_time', 'asc')
                                 ->get();
        // var_dump($data);die;
        // get classification info ( race type, age, runner name and postion)
        $result = [];
        for ($i = 0; $i < count($data); $i++) {
            // select race_type
            $result['race_type'][$i] =  $this->modelClass::join('race', 'runner_race.id_race', '=', 'race.id')
                                            ->join('race_types', 'race.id', '=', 'race_types.id')            
                                            ->select('race_types.name')
                                            ->get(); 
            var_dump($result); die;
            
            // select id_runner, name, birth_date (age)
            $result['runner'][$i] =  $this->modelClass::join('runner', 'runner_race.id_runner', '=', 'runner.id')
                                            ->select('runner.id', 'runner.name', 'runner.birth_date')
                                            ->get(); 

        }
        return $result; 
    }

    public function getByAge()
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
}