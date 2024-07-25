<?php

namespace App\Http\Controllers;

use App\Services\BaseService;

abstract class Controller
{
    protected $service;

    public function __construct()
    {
        $this->service = new $this->service;
    }
}
