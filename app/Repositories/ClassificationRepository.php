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
        $id = $this->getIdRace(); 

        // GETTING RUNNER AND RACES AND ORDERING BY RACE_TIME
        $data = $this->orderRacesAndSelectInfos($id);

        // PUT POSITION
        $data = $this->putPosition($data);
        return $data;
    }

    public function getByAge()
    {
        // GETTING ID_RACE
        $id = $this->getIdRace();

        // GETTING ID_AGE
        $idAge = $this->getIdAge();

        // GETTING RUNNER AND RACES AND ORDERING BY RACE_TIME AND AGE CATEGORY 
        $data = $this->selectInfos($id, $idAge);
        
        // PUT POSITION
        $data = $this->putPositionByAge($data);
        return $data;
    }  

    public function getIdRace()
    {
        return $this->modelClass::select('id_race')->groupBy('id_race')->get();
    }

    public function getIdAge()
    {
        return $this->modelClass::select('id_age')->groupBy('id_age')->get();
    }

    public function orderRacesAndSelectInfos($id) 
    {
        for ($i = 0; $i < count($id); $i++) {
            $data[$i] = $this->modelClass::join('race', 'race.id', '=', 'runner_race.id_race')
                ->where('race.id', $id[$i]->{'id_race'})
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
    
    // BY AGE
    public function selectInfos($id, $idAge) 
    {
        for ($i = 0; $i < count($id); $i++) {
            for ($age = 0; $age < count($idAge); $age++) {
                $data[$i][$age] = $this->modelClass::join('race', 'race.id', '=', 'runner_race.id_race')
                    ->where('race.id', $id[$i]->{'id_race'})
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
        }
        return $data;
    }

    public function putPosition($data)
    {
        for ($i = 0; $i < count($data); $i++) {
            for ($a = 0; $a < count($data[$i]); $a++) {
                $data[$i][$a]->{'position'} = $a + 1;
            }
        }
        return $data;
    }

    public function putPositionByAge($data)
    {
        for ($i = 0; $i < count($data); $i++) {
            for ($a = 0; $a < count($data[$i]); $a++) {
                for ($age = 0; $age < count($data[$i][$a]); $age++) {
                    $data[$i][$a][$age]->{'position'} = $age + 1;
                }
            }
        }
        return $data;
    }
}