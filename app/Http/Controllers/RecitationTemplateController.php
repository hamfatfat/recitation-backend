<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Controllers;
use App\recitationtemplate;
use App\Repositories\Repository;

use Illuminate\Http\Request;
class RecitationTemplateController extends Controller
{
    // space that we can use the repository from
   protected $model;
   public function __construct(recitationtemplate $recitationtemplate)
   {
       // set the model
       $this->model = new Repository($recitationtemplate);
   }
   public function index(){
       return $this->model->all();
   }
   public function store(Request $request)
   {
       // create record and pass in only fields that are fillable
       return $this->model->create($request->only($this->model->getModel()->fillable));
   }
   public function show($id)
   {
       return $this->model->show($id);
   }
   public function update(Request $request, $id)
   {
       // update model and only pass in the fillable fields
       $this->model->update($request->only($this->model->getModel()->fillable), $id);
       return $this->model->find($id);
   }
   public function destroy($id)
   {
       return $this->model->delete($id);
   }
}