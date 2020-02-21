<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\RaceTypes;
use Validator;

class RaceTypesController extends Controller
{
    public function list() 
    {

        $list = RaceTypes::all();
        if(count($list) < 1){
            return response()->json(["messsage" => "Records not found!"], 404);
        }
        return response()->json($list, 200);
    }

    public function findById($id)
    {
        $raceTypes = RaceTypes::find($id);
        if(is_null($raceTypes)){
            return response()->json(["messsage" => "Record not found!"], 404);
        }
        return response()->json($raceTypes, 200);
    }

    public function save(Request $request)
    {
        $rules = [
            'name' => 'required',
        ];
        $validator = Validator::make($request->all(), $rules);
        if($validator->fails()){
            return response()->json($validator->errors(), 400);
        }

        $raceTypes = RaceTypes::create($request->all());
        return response()->json($raceTypes, 201);
    }

    public function update(Request $request, $id)
    {
        $rules = [
            'name' => 'required',
        ];
        $validator = Validator::make($request->all(), $rules);
        if($validator->fails()){
            return response()->json($validator->errors(), 400);
        }

        $raceTypes = RaceTypes::find($id);
        if(is_null($raceTypes)){
            return response()->json(["messsage" => "Records not found!"], 404);
        }
        $raceTypes->update($request->all());
        return response()->json($raceTypes, 200);

    }

    public function delete($id)
    {
        $raceTypes = RaceTypes::find($id);
        if(is_null($raceTypes)){
            return response()->json(["messsage" => "Records not found!"], 404);
        }
        $raceTypes->delete();
        return response()->json(null, 204);
    }
}
