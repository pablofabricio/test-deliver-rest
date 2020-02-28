<?php 

namespace App\Repositories;

use App\RaceTypes;
use Validator;

class RaceTypesRepository implements RepositoryInterface
{
    protected $modelClass = RaceTypes::class;

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
        $rules = [
            'name'  => 'required',
        ];
        $validator = Validator::make($data, $rules);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
        return $this->modelClass::create($data);
    }

    public function update(array $data, $id)
    {
        $rules = [
            'name'  => 'required',
        ];
        $validator = Validator::make($data, $rules);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
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