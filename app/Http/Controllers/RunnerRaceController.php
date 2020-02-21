<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RunnerRaceController extends Controller
{
    public function overallClassification($id) 
    {
        
    }

    public function classificationByAge($id)
    {
        
    }

    public function save(Request $request)
    {
        $rules = [
            'id_runner' => 'required|integer',
            'id_race'  => 'required|integer',
            'initial_time'  => 'required|date_format:H:i:s',
            'final_time'  => 'required|date_format:H:i:s',
        ];
        $validator = Validator::make($request->all(), $rules);
        if($validator->fails()){
            return response()->json($validator->errors(), 400);
        }

        $runnerRace = RunnerRace::create($request->all());
        return response()->json($runnerRace, 201);
    }

    public function update(Request $request, $id)
    {
        
    }

    public function delete($id)
    {
        $runnerRace = RunnerRace::find($id);
        if(is_null($runnerRace)){
            return response()->json(["messsage" => "Records not found!"], 404);
        }
        $runnerRace->delete();
        return response()->json(null, 204);
    }

}
