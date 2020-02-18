<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ProofTypes;
use Validator;

class ProofTypesController extends Controller
{
    public function list() 
    {

        $list = ProofTypes::all();
        if(count($list) < 1){
            return response()->json(["messsage" => "Records not found!"], 404);
        }
        return response()->json($list, 200);
    }

    public function findById($id)
    {
        $proofTypes = ProofTypes::find($id);
        if(is_null($proofTypes)){
            return response()->json(["messsage" => "Record not found!"], 404);
        }
        return response()->json($proofTypes, 200);
    }

    public function save(Request $request)
    {
        $rules = [
            'name' => 'required|min:1',
        ];
        $validator = Validator::make($request->all(), $rules);
        if($validator->fails()){
            return response()->json($validator->errors(), 400);
        }

        $proofTypes = ProofTypes::create($request->all());
        return response()->json($proofTypes, 201);
    }

    public function update(Request $request, $id)
    {
        $rules = [
            'name' => 'required|min:1',
        ];
        $validator = Validator::make($request->all(), $rules);
        if($validator->fails()){
            return response()->json($validator->errors(), 400);
        }

        $proofTypes = ProofTypes::find($id);
        if(is_null($proofTypes)){
            return response()->json(["messsage" => "Records not found!"], 404);
        }
        $proofTypes->update($request->all());
        return response()->json($proofTypes, 200);

    }

    public function delete($id)
    {
        $proofTypes = ProofTypes::find($id);
        if(is_null($proofTypes)){
            return response()->json(["messsage" => "Records not found!"], 404);
        }
        $proofTypes->delete();
        return response()->json(null, 204);
    }
}
