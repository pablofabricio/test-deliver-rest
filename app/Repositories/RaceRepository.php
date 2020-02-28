<?php 

namespace App\Repositories;

use App\Race;
use Validator;

class RaceRepository implements RepositoryInterface
{
    protected $modelClass = Race::class;

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
            'date'  => 'required|date_format:Y-m-d',
            'id_race_type' => 'required|integer',
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
            'date'  => 'date_format:Y-m-d',
            'id_race_type' => 'integer',
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