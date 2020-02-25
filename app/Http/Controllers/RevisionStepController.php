<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Controllers;
use App\revisionstep;
use App\Repositories\Repository;
use Illuminate\Support\Facades\Log;

use Illuminate\Http\Request;
class RevisionStepController extends Controller
{
    // space that we can use the repository from
   protected $model;
   protected $revisionstep;
   public function __construct(revisionstep $revisionstep)
   {
       // set the model
       $this->revisionstep = $revisionstep;
       $this->model =new Repository($revisionstep);
   }
   public function index()
   {
       return $this->model->all();
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
       return $this->revisionstep->destroy($id);
   }
}