<?php

namespace App\Services;

use Illuminate\Database\Eloquent\Model;

class BaseService 
{

    protected string $model;
    
    public function get()
    {
        return $this->model::get();
    }
}