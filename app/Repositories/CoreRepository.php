<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

abstract class CoreRepository{

    protected Model $model;

    public function __construct()
    {
        return $this->model = new ($this->getModelClass());
    }

    abstract protected function getModelClass();
}