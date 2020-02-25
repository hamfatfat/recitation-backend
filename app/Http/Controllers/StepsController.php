<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Controllers;
use App\steps;
use App\revisionstep;
use App\schedule;
use App\recitationstep;
use App\Repositories\Repository;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
class StepsController extends Controller
{
    // space that we can use the repository from
   protected $model;
   protected $revisionModel;
   protected $scheduleModel;
   protected $recitationModel;
   public function __construct(steps $steps, revisionstep $revisions, schedule $schedule, recitationstep $recitationstep)
   {
       // set the model
       $this->model = new Repository($steps);
       $this->revisionModel = new Repository($revisions);
       $this->scheduleModel = new Repository($schedule);
       $this->recitationModel = new Repository($recitationstep);
   }
   public function index(){
        return $this->model->all();
   }
   public function findByTemplateId($recId)
   {
       return $this->model->whereQuery('recitationtemplate_id','=', $recId);
   }
   public function store(Request $request)
   {
       // create record and pass in only fields that are fillable
       return $this->model->create($request->only($this->model->getModel()->fillable));
   }
   public function show($id)
   {   $step = $this->model->show($id);
       $step->revision = $this->revisionModel->whereQuery('step_id','=', $id);
       $step->schedule = $this->scheduleModel->whereQueryWithForeignModel('step_id','=', $id, 'recitationstep', 'schedule_id','id');
       return $step;
   }
   public function getAllSteps(){
    $steps = $this->model->all();
    foreach ($steps as &$step) {
        $step->revision = $this->revisionModel->whereQuery('step_id','=',  $step->id);
        $step->schedule = $this->scheduleModel->whereQueryWithForeignModel('step_id','=',  $step->id, 'recitationstep', 'schedule_id','id');
       
    }return $steps;
   }
   public function update(Request $request, $id)
   {
       // update model and only pass in the fillable fields
       $this->model->update($request->only($this->model->getModel()->fillable), $id);
       return $this->model->show($id);
   }
   public function destroy($id)
   {
       return $this->model->delete($id);
   }
}