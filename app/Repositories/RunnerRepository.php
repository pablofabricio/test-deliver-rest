<?php 

namespace App\Repositories;

use App\Runner;
use Validator;

class RunnerRepository implements RepositoryInterface
{
    protected $modelClass = Runner::class;

    public function getAll() 
    {
        $data = $this->modelClass::all();
        if (count($data) < 1) {
            throw new Exception("Records not found!");
        }
        return $data;
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
            'name' => 'required|min:3',
            'birth_date'  => 'required|date_format:Y-m-d',
            'CPF' => 'required|min:11',
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
            'name' => 'required|min:3',
            'birth_date'  => 'required|date_format:Y-m-d',
            'CPF' => 'required|min:11',
        ];
        $validator = Validator::make($data, $rules);
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