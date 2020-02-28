<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\ClassificationRepository;

class ClassificationController extends Controller
{
    private $repository;
    
    public function __construct(ClassificationRepository $classificationRepository) 
    {
        $this->repository = $classificationRepository;
    }

    public function overallClassification()
    {
        $data = $this->repository->getOverall();
        return response()->json($data, 200);
    }

    public function classificationByAge()
    {
        $data = $this->repository->getByAge();
        return response()->json($data, 200);
    }
}
