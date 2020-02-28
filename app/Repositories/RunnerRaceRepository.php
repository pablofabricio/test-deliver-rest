<?php 

namespace App\Repositories;

use App\RunnerRace;
use Validator;

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

        $this->modelClass::where('id', $id)->update($data);
        return $this->modelClass::find($id);
    }

    public function delete($id)
    {
        $data = $this->modelClass::find($id);
        return $data->delete($id);
    }
}