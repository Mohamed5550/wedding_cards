<?php

namespace App\Http\Controllers;

use App\Services\BaseService;
use App\Services\CountryService;
use Illuminate\Http\Request;

class CountryController extends Controller
{

    protected $service = CountryService::class;

    public function index()
    {
        return [
            "countries" => $this->service->get()
        ];
    }
}
