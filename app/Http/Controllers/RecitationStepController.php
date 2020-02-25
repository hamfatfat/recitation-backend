<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Controllers;
use App\recitationstep;
use App\Repositories\Repository;
use Illuminate\Support\Facades\Log;

use Illuminate\Http\Request;
class RecitationStepController extends Controller
{
    // space that we can use the repository from
   protected $model;
   protected $recitationstep;
   public function __construct(recitationstep $recitationstep)
   {
       // set the model
       $this->recitationstep = $recitationstep;
       $this->model =new Repository($recitationstep);
   }
   public function index()
   {
       return $this->model->all();
   }
   public function findByRevisionId($revId)
   {
    Log::info('Showing user profile for user: '.$revId);
       return $this->model->whereQuery('rev_id','=', $revId);
   }

   public function findByScheduleId($scheduleId)
   {
    Log::info('Showing user profile for user: '.$scheduleId);
       return $this->model->whereQuery('schedule_id','=', $scheduleId);
   }
   public function store(Request $request)
   {
       // create record and pass in only fields that are fillable
       return $this->model->create($request->only($this->model->getmodel()->fillable));
   }
   public function show($id)
   {
    Log::info('Showing user profile for user: '.$id);
       return $this->model->show($id);
   }
   public function update(Request $request, $id)
   {
       // update model and only pass in the fillable fields
       $this->model->update($request->only($this->model->getmodel()->fillable), $id);
       return $this->model->show($id);
   }
   public function destroy($id)
   {
       return $this->model->delete($id);
   }
}