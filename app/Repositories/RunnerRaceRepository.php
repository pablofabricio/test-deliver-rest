<?php 

namespace App\Repositories;

use App\RunnerRace;
use Validator;
use Carbon;

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
            'initial_time' => 'date_format:H:i',
            'final_time' => 'date_format:H:i|after:initial_time',
        ];
        $validator = Validator::make($data, $rules);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
        
        // VERIFIER IF EXISTS RUNNER AND RACE
        $runner = $this->modelClass::find($data['id_runner']);
        if (is_null($runner)) {
            return response()->json(["messsage" => "Runner not found!"], 404);
        }
        $race = $this->modelClass::find($data['id_race']);
        if (is_null($race)) {
            return response()->json(["messsage" => "Race not found!"], 404);
        }
        
        // CALCULATING THE RACE TIME 
        $firstTime = new \DateTime($data['final_time']);
        $result = $firstTime->diff(new \DateTime($data['initial_time']));
        $data['race_time'] = $result->h.':'. $result->i;

        // CREATE
        return $this->modelClass::create($data);
    }

    public function update(array $data, $id)
    {
        $rules = [
            'id_runner' => 'integer',
            'id_race' => 'integer',
            'initial_time' => 'date_format:H:i',
            'final_time' => 'date_format:H:i|after:initial_time',
        ];
        $validator = Validator::make($data, $rules);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        // VERIFIER IF EXISTS RUNNER AND RACE
        if (in_array("id_runner", $data)) {
            $runner = $this->modelClass::find($data['id_runner']);
            if (is_null($runner)) {
                return response()->json(["messsage" => "Runner not found!"], 404);
            }
        }
        if (in_array("id_race", $data)) {
            $race = $this->modelClass::find($data['id_race']);
            if (is_null($race)) {
                return response()->json(["messsage" => "Race not found!"], 404);
            }
        }

        // VERIFIER IF EXISTS INITIAL TIME OR FINAL_TIME
        // if (in_array("final_time", $data)) {
        //     $firstTime = new \DateTime($data['final_time']);   
        // }
        // if (in_array("initial_time", $data)) {
            
        // }

        $this->modelClass::where('id', $id)->update($data);
        return $this->modelClass::find($id);
    }

    public function delete($id)
    {
        $data = $this->modelClass::find($id);
        return $data->delete($id);
    }
}