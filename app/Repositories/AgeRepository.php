<?php 

namespace App\Repositories;

use App\Age;
use Validator;
use Exception;

class AgeRepository implements RepositoryInterface
{
    protected $modelClass = Age::class;

    public function getAll() 
    {
        return $this->modelClass::all();
    }

    public function getById($id)
    {
        if ($this->verifyIfExists($id)) {
            return $this->modelClass::find($id);
        } else {
            throw new Exception("Record not found");
        }
    }

    public function create(array $data)
    {
        $rules = [
            'initial_age'  => 'required|integer',
            'final_age'  => 'required|integer',
        ];
        $validator = Validator::make($data, $rules);
        if ($validator->fails()) {
            throw new Exception($validator->errors());
        }
        return $this->modelClass::create($data);
    }

    public function update(array $data, $id)
    {
        $rules = [
            'initial_age'  => 'integer',
            'final_age'  => 'integer',
        ];
        $validator = Validator::make($data, $rules);
        if ($validator->fails()) {
            throw new Exception($validator->errors());
        }
        if ($this->verifyIfExists($id)) {
            $this->modelClass::where('id', $id)->update($data);
            return $this->modelClass::find($id);
        } else {
            throw new Exception("Record not found");
        }
    }

    public function delete($id)
    {
        if ($this->verifyIfExists($id)) {
            $data = $this->modelClass::find($id);
            return $data->delete($id);
        } else {
            throw new Exception("Record not found");
        }
    }

    private function verifyIfExists($id)
    {
        if (is_null($this->modelClass::find($id))) {
            return false;
        }
        return true;
    }
}