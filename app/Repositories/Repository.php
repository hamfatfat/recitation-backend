<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Repositories;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;
class Repository implements RepositoryInterface
{
    // model property on class instances
    private $model;
    // Constructor to bind model to repo
    public function __construct(Model $model)
    {
        $this->model = $model;
    }
    // Get all instances of model
    public function all()
    {
        return $this->model->all();
    }
    // create a new record in the database
    public function create(array $data)
    {
        return $this->model->create($data);
    }
    // update record in the database
    public function update(array $data, $id)
    {
        $record = $this->model->find($id);
        return $record->update($data);
    }
    // remove record from the database
    public function delete($id)
    {
        return $this->model->destroy($id);
    }
    // show the record with the given id
    public function show($id)
    {
        return $this->model->find($id);
    }
    // Get the associated model
    public function getModel()
    {
        return $this->model;
    }
    // Set the associated model
    public function setModel($model)
    {
        $this->model = $model;
        return $this;
    }
    // Eager load database relationships
    public function with($relations)
    {
        return $this->model->with($relations);
    } 
    // Eager load database relationships
    public function whereQuery($key, $operator, $value)
    {        
        Log::info('where: '.$key.'.'.$operator.'.'.$value);
        return $this->model->where($key, $operator, $value)->get();
    }
    public function whereQueryWithForeignModel($key, $operator, $value, $withModel, $foreignId, $otherId)
    {        
        return $this->model->with($withModel)->where($key, $operator, $value)->get();
        Log::info('where: '.$key.'.'.$operator.'.'.$value);
    }
    public function whereIn($key, $value)
    {        
        return $this->model->whereIn($key, $value)->get();
    }
}