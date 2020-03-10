<?php 

namespace App\Repositories;

use App\RunnerRace;
use Illuminate\Support\Facades\DB;

class ClassificationRepository
{
    protected $modelClass = RunnerRace::class;

    public function getOverall() 
    {
        // GETTING ID_RACE
        $idRace = $this->getIdRace(); 

        // GETTING RUNNER AND RACES AND ORDERING BY RACE_TIME
        $data = $this->orderRacesAndSelectInfos($idRace);

        // PUT POSITION
        $data = $this->allPosition($data);
        return $data;
    }

    public function getByAge()
    {
        // GETTING ID_RACE
        $idRace = $this->getIdRace();

        // GETTING ID_AGE
        $idAge = $this->getIdAge();

        // GETTING RUNNER AND RACES AND ORDERING BY RACE_TIME AND AGE CATEGORY 
        $data = $this->putInfos($idRace, $idAge);
        
        // PUT POSITION
        $data = $this->PositionByAge($data);
        return $data;
    }  

    // get all possible races in runner_race and to group
    private function getIdRace()
    {
        return $this->modelClass::select('id_race')->groupBy('id_race')->get();
    }

    // get all possible ages in runner_race and to group
    private function getIdAge()
    {
        return $this->modelClass::select('id_age')->groupBy('id_age')->get();
    }

    // GET ALL (method)
    private function orderRacesAndSelectInfos($idRace) 
    {
        for ($race = 0; $race < count($idRace); $race++) {
            $data[$race] = $this->modelClass::join('race', 'race.id', '=', 'runner_race.id_race')
                ->where('race.id', $idRace[$race]->{'id_race'})
                ->select('id_race', 
                         'id_runner',
                         // GET race_type
                         (DB::raw(
                            "(SELECT name FROM race_types 
                              WHERE race.id_race_type = race_types.id ) 
                              AS race_type")),
                         // GET runner age
                         (DB::raw(
                             "(SELECT YEAR(CURDATE()) - YEAR(birth_date) FROM runner 
                               WHERE runner.id = runner_race.id_runner) 
                               AS runner_age")),
                         // GET runner name
                         (DB::raw(
                             "(SELECT name FROM runner 
                               WHERE runner.id = runner_race.id_runner) 
                               AS runner_name")))
                ->orderBy('runner_race.race_time')
                ->get();                
        }
        return $data;
    }
    
    // GET ALL (method)
    private function allPosition($data)
    {
        for ($race = 0; $race < count($data); $race++) {
            $data = $this->putPosition($data, $race);
        }
        return $data;
    }

    // GET ALL (method)
    private function putPosition($data, $race)
    {
        for ($user = 0; $user < count($data[$race]); $user++) {
            $data[$race][$user]->{'position'} = $user+ 1;
        }
        return $data;
    }

    // GET BY AGE (method)
    private function putInfos($idRace, $idAge) 
    {
        for ($race = 0; $race < count($idRace); $race++) {
            $data[$race] = $this->getInfos($idRace, $idAge, $race);
        }
        return $data;
    }
    
    // GET BY AGE (method)
    private function getInfos($idRace, $idAge, $race)
    {
        for ($age = 0; $age < count($idAge); $age++) {
            $data[$age] = $this->modelClass::join('race', 'race.id', '=', 'runner_race.id_race')
                ->where('race.id', $idRace[$race]->{'id_race'})
                ->where('runner_race.id_age', $idAge[$age]->{'id_age'})
                ->select('id_race', 
                         'id_runner',
                         // GET race_type
                         (DB::raw(
                            "(SELECT name FROM race_types 
                              WHERE race.id_race_type = race_types.id ) 
                              AS race_type")),
                         // GET runner age
                         (DB::raw(
                             "(SELECT YEAR(CURDATE()) - YEAR(birth_date) FROM runner 
                               WHERE runner.id = runner_race.id_runner) 
                               AS runner_age")),
                         // GET age
                         (DB::raw(
                             "(SELECT YEAR(CURDATE()) - YEAR(birth_date) FROM runner 
                               WHERE runner.id = runner_race.id_runner) 
                               AS runner_age")),
                         // GET CATEGORY
                         (DB::raw(
                             "(SELECT CONCAT( initial_age, '-', final_age) FROM age 
                               WHERE age.id = runner_race.id_age) 
                               AS category")),
                         // GET runner name
                         (DB::raw(
                             "(SELECT name FROM runner 
                               WHERE runner.id = runner_race.id_runner) 
                               AS runner_name")))
                ->orderBy('runner_race.race_time')
                ->get();                
        }
        return $data;
    }

    // GET BY AGE (method)
    private function PositionByAge($data)
    {
        for ($race = 0; $race < count($data); $race++) {
            $data = $this->countCategory($data, $race);
        }
        return $data;
    }

    // GET BY AGE (method)
    private function countCategory($data, $race)
    {
        for ($category = 0; $category < count($data[$race]); $category++) {
            $data = $this->putPositionByAge($data, $race, $category);
        }
        return $data;
    }
    
    // GET BY AGE (method)
    private function putPositionByAge($data, $race, $category)
    {
        for ($user = 0; $user < count($data[$race][$category]); $user++) {
            $data[$race][$category][$user]->{'position'} = $user + 1;
        }
        return $data;
    }
}