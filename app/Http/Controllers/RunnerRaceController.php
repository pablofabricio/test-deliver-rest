<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\RunnerRaceRepository;


class RunnerRaceController extends Controller
{
    private $repository;
    
    public function __construct(RunnerRaceRepository $runnerRaceRepository) 
    {
        $this->repository = $runnerRaceRepository;
    }

    public function list() 
    {
        $list = $this->repository->getAll();
        if (count($list) < 1) {
            return response()->json(["messsage" => "Records not found!"], 404);
        }
        return response()->json($list, 200);
    }

    public function findById($id)
    {
        $data = $this->repository->getById($id);
        if(is_null($data)){
            return response()->json(["messsage" => "Record not found!"], 404);
        }
        return response()->json($data, 200);
    }

    public function save(Request $request)
    {
        $data = $this->repository->create($request->all());
        return response()->json($data, 201);
    }

    public function update(Request $request, $id)
    {
        $data = $this->repository->getById($id);
        if (is_null($data)) {
            return response()->json(["messsage" => "Record not found!"], 404);
        }
        $data = $this->repository->update($request->all(), $id);
        return response()->json($data, 200);
    }

    public function delete($id)
    {
        $data = $this->repository->getById($id);
        if (is_null($data)) {
            return response()->json(["messsage" => "Record not found!"], 404);
        }
        $data = $this->repository->delete($id);
        return response()->json(null, 200);
    }
}
