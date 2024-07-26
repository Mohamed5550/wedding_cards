<?php

namespace App\Http\Controllers;

use App\Services\BaseService;

abstract class Controller
{
    protected $service = null;

    public function __construct()
    {
        if($this->service)
            $this->service = new $this->service;
    }
}
