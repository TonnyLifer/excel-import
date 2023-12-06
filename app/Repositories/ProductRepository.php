<?php

namespace App\Repositories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Model;

class ProductRepository extends CoreRepository{

    public function getModelClass(){
        return Product::class;
    }

    public function getById($id){
        return $this->startConditions()->find($id);
    }

    public function getAll(){
        return $this->startConditions()->all();
    }

    protected function startConditions(){
        return clone $this->model;
    }
}