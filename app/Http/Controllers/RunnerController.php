<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\RunnerRepository;

class RunnerController extends Controller
{

    private $repository;
    
    public function __construct(RunnerRepository $runnerRepository) 
    {
        $this->repository = $runnerRepository;
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
        try {
            $data = $this->repository->getById($id);
            return response()->json($data, 200);
        } catch (\Exception $e) {
            return response()->json(["message" => $e->getMessage()], 400);
        }
    }

    public function save(Request $request)
    {
        try {
            $data = $this->repository->create($request->all());
            return response()->json($data, 201);
        } catch (\Exception $e) {
            return response()->json(["message" => $e->getMessage()], 400);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $data = $this->repository->update($request->all(), $id);
            return response()->json($data, 200);
        } catch (\Exception $e) {
            return response()->json(["message" => $e->getMessage()], 400);
        }
    }

    public function delete($id)
    {
        try {
            $data = $this->repository->delete($id);
            return response()->json(null, 200);
        } catch (\Exception $e) {
            return response()->json(["message" => $e->getMessage()], 404);
        }
    }
}
