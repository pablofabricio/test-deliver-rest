<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Runner;
use Validator;


class RunnerController extends Controller
{
    public function list() 
    {

        $list = Runner::all();
        if(count($list) < 1){
            return response()->json(["messsage" => "Records not found!"], 404);
        }
        return response()->json($list, 200);
    }

    public function findById($id)
    {
        $runner = Runner::find($id);
        if(is_null($runner)){
            return response()->json(["messsage" => "Record not found!"], 404);
        }
        return response()->json($runner, 200);
    }

    public function save(Request $request)
    {
        $rules = [
            'name' => 'required|min:3',
            'CPF'  => 'required|min:11|max:11',
        ];
        $validator = Validator::make($request->all(), $rules);
        if($validator->fails()){
            return response()->json($validator->errors(), 400);
        }

        $runner = Runner::create($request->all());
        return response()->json($runner, 201);
    }

    public function update(Request $request, $id)
    {
        $rules = [
            'name' => 'required|min:3',
            'CPF'  => 'required|min:11|max:11',
        ];
        $validator = Validator::make($request->all(), $rules);
        if($validator->fails()){
            return response()->json($validator->errors(), 400);
        }

        $runner = Runner::find($id);
        if(is_null($runner)){
            return response()->json(["messsage" => "Records not found!"], 404);
        }
        $runner->update($request->all());
        return response()->json($runner, 200);

    }

    public function delete($id)
    {
        $runner = Runner::find($id);
        if(is_null($runner)){
            return response()->json(["messsage" => "Records not found!"], 404);
        }
        $runner->delete();
        return response()->json(null, 204);
    }
}

