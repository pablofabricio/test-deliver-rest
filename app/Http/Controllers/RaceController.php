<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Race;
use Validator;

class RaceController extends Controller
{
    public function list() 
    {

        $list = Race::all();
        if(count($list) < 1){
            return response()->json(["messsage" => "Records not found!"], 404);
        }
        return response()->json($list, 200);
    }

    public function findById($id)
    {
        $race = Race::find($id);
        if(is_null($race)){
            return response()->json(["messsage" => "Record not found!"], 404);
        }
        return response()->json($race, 200);
    }

    public function save(Request $request)
    {
        $rules = [
            'date'  => 'required|date_format:Y-m-d',
        ];
        $validator = Validator::make($request->all(), $rules);
        if($validator->fails()){
            return response()->json($validator->errors(), 400);
        }

        $race = Race::create($request->all());
        return response()->json($race, 201);
    }

    public function update(Request $request, $id)
    {
        $rules = [
            'date'  => 'required|date_format:Y-m-d',
        ];
        $validator = Validator::make($request->all(), $rules);
        if($validator->fails()){
            return response()->json($validator->errors(), 400);
        }

        $race = Race::find($id);
        if(is_null($race)){
            return response()->json(["messsage" => "Records not found!"], 404);
        }
        $race->update($request->all());
        return response()->json($race, 200);

    }

    public function delete($id)
    {
        $race = Race::find($id);
        if(is_null($race)){
            return response()->json(["messsage" => "Records not found!"], 404);
        }
        $race->delete();
        return response()->json(null, 204);
    }
}
