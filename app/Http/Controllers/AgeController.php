<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Age;
use Validator;

class AgeController extends Controller
{
    public function list() 
    {

        $list = Age::all();
        if(count($list) < 1){
            return response()->json(["messsage" => "Records not found!"], 404);
        }
        return response()->json($list, 200);
    }

    public function findById($id)
    {
        $age = Age::find($id);
        if(is_null($age)){
            return response()->json(["messsge" => "Record not found!"], 404);
        }
        return response()->json($age, 200);
    }

    public function save(Request $request)
    {
        $rules = [
            'initial_age' => 'required|integer',
            'final_age'  => 'required|integer',
        ];
        $validator = Validator::make($request->all(), $rules);
        if($validator->fails()){
            return response()->json($validator->errors(), 400);
        }

        $age = Age::create($request->all());
        return response()->json($age, 201);
    }

    public function update(Request $request, $id)
    {
        $rules = [
            'initial_age' => 'required|integer',
            'final_age'  => 'required|integer',
        ];
        $validator = Validator::make($request->all(), $rules);
        if($validator->fails()){
            return response()->json($validator->errors(), 400);
        }

        $age = Age::find($id);
        if(is_null($age)){
            return response()->json(["messsage" => "Records not found!"], 404);
        }
        $age->update($request->all());
        return response()->json($age, 200);

    }

    public function delete($id)
    {
        $age = Age::find($id);
        if(is_null($age)){
            return response()->json(["messsage" => "Records not found!"], 404);
        }
        $age->delete();
        return response()->json(null, 204);
    }
}
