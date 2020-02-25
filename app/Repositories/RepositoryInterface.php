<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Repositories;
interface RepositoryInterface
{
    public function all();
    public function create(array $data);
    public function update(array $data, $id);
    public function delete($id);
    public function show($id);
    public function whereQuery($key, $operator, $value);
    public function whereIn($key, $value);
    public function whereQueryWithForeignModel($key, $operator, $value, $withModel, $foreignId, $otherId);
}