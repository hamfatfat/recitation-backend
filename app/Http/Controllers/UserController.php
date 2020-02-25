<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Controllers;
use App\User;
use App\UserRole;
use App\center;
use App\Repositories\Repository;
use Illuminate\Support\Facades\Log;

use Illuminate\Http\Request;
class UserController extends Controller
{
    // space that we can use the repository from
   protected $model;
   protected $user;
   protected $center;
   public function __construct(user $user, center $center)
   {
       // set the model
       $this->user = $user;
       $this->model =new Repository($user);
       $this->centerModel = new Repository($center);
   }
   public function index()
   {
       return $this->model->all();
   }

   public function findTeacherByCenterId($centerId){
        return $this->model->whereQueryWithForeignModel('center_id','=', $centerId, 'users_center', 'user_id','id');
   }
   public function  findAllTeachers(){
       
    Log::info('Showing user profile for user: '.implode(" ",UserRole::getAllowedRoles("Teacher")));
    return user::with(['centers'])->where('roles','like',"%Teacher%")->get();
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
    $request->validate([
        'name' => 'required|string',
        'email' => 'required|string|email|unique:users',
        'password' => 'required|string',
        'roles' => 'required'
    ]);   
    $user = new User([
    'name' => $request->name,
    'email' => $request->email,
    'password' => bcrypt($request->password)
]);

$user->addRole($request->roles);
       // create record and pass in only fields that are fillable
       $user->save();
       $user->centers()->sync($request->centers);


       return user::with(['centers'])->where('id','=',$user->id)->first();
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
      $user =user::with(['centers'])->where('id','=',$id)->first();
       $user->centers()->sync($request->centers);
       return user::with(['centers'])->where('id','=',$user->id)->first();
   }
   public function destroy($id)
   {   $user =user::with(['centers'])->where('id','=',$id)->first();
        $user->centers()->sync([]);
       return $this->user->destroy($id);
   }
}