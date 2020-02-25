<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Controllers;
use App\center;
use App\Repositories\Repository;
use Illuminate\Http\Request;

class CenterController extends Controller
{
    // space that we can use the repository from
   protected $model;
   public function __construct(center $center)
   {
       $this->center = $center;
       // set the model
       $this->model = new Repository($center);
   }
   public function index(){
       return  center::with(['users'])->get();
   }
   public function store(Request $request)
   {
       // create record and pass in only fields that are fillable
       return $this->model->create($request->only($this->model->getModel()->fillable));
   }
   public function show($id)
   {
       $center =center::with(['users'])->where('id','=',$id)->first();
       return $center;
   }
   public function update(Request $request, $id)
   {
       // update model and only pass in the fillable fields
       $this->model->update($request->only($this->model->getModel()->fillable), $id);
       return $this->model->find($id);
   }
   public function destroy($id)
   { 
       $center =center::with(['users'])->where('id','=',$id)->first();
       $center->users()->sync([]);
       return $this->center->destroy($id);
   }
}