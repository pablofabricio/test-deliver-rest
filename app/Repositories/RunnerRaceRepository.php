<?php 

namespace App\Repositories;

use App\RunnerRace;
use App\Race;
use App\Age;
use App\Runner;
use Validator;
use Carbon;
use Illuminate\Support\Facades\DB;
use Exception;

class RunnerRaceRepository implements RepositoryInterface
{
    protected $modelClass = RunnerRace::class;

    public function getAll() 
    {
        $data = $this->modelClass::all();
        if (count($data) < 1) {
            throw new Exception("Records not found!");
        }
        return $data;
    }

    public function getById($id)
    {
        if ($this->verifyIfExists($id)) {
            return $this->modelClass::find($id);
        } else {
            throw new Exception("Record not found");
        }
    }

    public function create(array $data)
    {
        // VERIFIER REQUEST
        $rules = [
            'id_runner' => 'required|integer',
            'id_race' => 'required|integer',
            'id_age' => 'required|integer',
            'initial_time' => 'date_format:H:i',
            'final_time' => 'date_format:H:i|after:initial_time',
        ];
        $validator = Validator::make($data, $rules);
        if ($validator->fails()) {
            throw new Exception($validator->errors());
        }

        // VALIDATING THE VALUES
        $this->verification($data);

        // CALCULATING THE RACE TIME 
        $data['race_time'] = $this->calculateRaceTime($data);

        // CREATE
        return $this->modelClass::create($data);
    }
    
    public function delete($id)
    {
        if ($this->verifyIfExists($id)) {
            $data = $this->modelClass::find($id);
            return $data->delete($id);
        } else {
            throw new Exception("Record not found");
        }
    }

    private function verifyIfExists($id)
    {
        if (is_null($this->modelClass::find($id))) {
            return false;
        }
        return true;
    }

    private function calculateRaceTime($data)
    {
        $firstTime = new \DateTime($data['final_time']);
        $result = $firstTime->diff(new \DateTime($data['initial_time']));
        return $result->h.':'. $result->i;
    }

    private function verification($data) 
    {
        // VERIFIER IF EXISTS RUNNER
        $runner = Runner::find($data['id_runner']);
        if (is_null($runner)) {
            throw new Exception("Runner not found!");
        }

        // VERIFIER IF EXISTS RACE
        $race = Race::find($data['id_race']);
        if (is_null($race)) {
            throw new Exception("Race not found!");
        }
        
        // VERIFIY IF RUNNER IS OVER 18 YEARS OLD
        $runner = Runner::select(
            (DB::raw('(SELECT YEAR(CURDATE()) - YEAR(birth_date) FROM runner 
                       WHERE runner.id ='.$data['id_runner'].') AS AGE'
                    )))
            ->where('id', $data['id_runner'])
            ->get();
        if ($runner[0]['AGE'] < 18) {
            throw new Exception("Runner is under 18!");
        }
        
        // VERIFY IF RUNNER NOT HAVE RACE REGISTERED IN THE SAME DATA
        $registeredRace = $this->modelClass::where('id_runner', $data['id_runner'])
            ->select('id_race')
            ->groupBy('id_race')
            ->get();
        
        $choosenRaceDate =  Race::where('id', $data['id_race'])
            ->select('date')
            ->get();

        for ($i = 0; $i < count($registeredRace); $i++) {
            $a = Race::where('id', $registeredRace[$i]['id_race'])
                ->where('date', $choosenRaceDate[0]['date'])
                ->get();
            if (count($a) > 0) {
                throw new Exception("Runner is already registered for a race on the same date");
            }
        }

        // VERIFIER IF EXISTS AGE
        $age = Age::find($data['id_age']);
        if (is_null($age)) {
            throw new Exception("Age not found!");
        }

    }
    
    public function update($data, $id) {}

}