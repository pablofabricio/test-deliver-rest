<?php 

namespace App\Repositories;

use App\RunnerRace;
use App\Race;
use App\Age;
use App\Runner;
use Validator;
use Carbon;
use Illuminate\Support\Facades\DB;

class RunnerRaceRepository implements RepositoryInterface
{
    protected $modelClass = RunnerRace::class;

    public function getAll() 
    {
        return $this->modelClass::all();
    }

    public function getById($id)
    {
        return $this->modelClass::find($id);
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
            return response()->json($validator->errors(), 400);
        }

        // VERIFIER IF EXISTS RUNNER
        $runner = Runner::find($data['id_runner']);
        if (is_null($runner)) {
            return response()->json(["messsage" => "Runner not found!"], 404);
        }

        // VERIFIER IF EXISTS RACE
        $race = Race::find($data['id_race']);
        if (is_null($race)) {
            return response()->json(["messsage" => "Race not found!"], 404);
        }
        
        // VERIFIY IF RUNNER IS OVER 18 YEARS OLD
        $runner = Runner::select(
            (DB::raw('(SELECT YEAR(CURDATE()) - YEAR(birth_date) FROM runner 
                       WHERE runner.id ='.$data['id_runner'].') AS AGE'
                    )))
            ->where('id', $data['id_runner'])
            ->get();
        if ($runner[0]['AGE'] < 18) {
            return response()->json(["messsage" => "Runner is under 18!"], 404);
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
            $data = Race::where('id', $registeredRace[$i]['id_race'])
                ->where('date', $choosenRaceDate[0]['date'])
                ->get();
            if (!is_null($data)) {
                return response()
                    ->json(
                        ["messsage" => 
                            "Runner is already registered for a race on the same date"
                        ], 
                        404
                    );
            }
        }

        // VERIFIER IF EXISTS AGE
        $age = Age::find($data['id_age']);
        if (is_null($age)) {
            return response()->json(["messsage" => "Age not found!"], 404);
        }
        
        // CALCULATING THE RACE TIME 
        $data['race_time'] = $this->calculateRaceTime($data);

        // CREATE
        return $this->modelClass::create($data);
    }
    
    public function delete($id)
    {
        $data = $this->modelClass::find($id);
        return $data->delete($id);
    }

    private function calculateRaceTime($data)
    {
        $firstTime = new \DateTime($data['final_time']);
        $result = $firstTime->diff(new \DateTime($data['initial_time']));
        return $result->h.':'. $result->i;
    }
    
    public function update($data, $id) {}

}