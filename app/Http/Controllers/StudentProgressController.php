<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Controllers;
use App\StudentProgress;
use App\Repositories\Repository;
use Illuminate\Http\Request;

class StudentProgressController extends Controller
{
    // space that we can use the repository from
   protected $model;
   public function __construct(studentProgress $studentProgress)
   {
       $this->studentProgress = $studentProgress;
       // set the model
       $this->model = new Repository($studentProgress);
   }
   public function index(){
       return studentProgress::with(['users'])->get();
   }
   public function store(Request $request)
   {
       // create record and pass in only fields that are fillable
       return $this->model->create($request->only($this->model->getModel()->fillable));
   }
   public function show($id)
   {
       $studentProgress = studentProgress::with(['users'])->where('id','=',$id)->first();
       return $studentProgress;
   }
   public function findByUserAndStepId($userId, $stepId)
   {
       return $this->studentProgress->where('user_id','=', $userId)->where('step_id','=', $stepId)->get();
   }

   public function update(Request $request, $id)
   {
       // update model and only pass in the fillable fields
       $this->model->update($request->only($this->model->getModel()->fillable), $id);
       return $this->model->find($id);
   }
   public function destroy($id)
   { 
       $studentProgress = studentProgress::with(['users'])->where('id','=',$id)->first();
       $studentProgress->users()->sync([]);
       return $this->studentProgress->destroy($id);
   }
}