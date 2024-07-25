<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\FeatureService;
use App\Http\Resources\FeatureResource;
use App\Http\Resources\FeatureCollection;

class FeatureController extends Controller
{
    protected $service = FeatureService::class;

    public function index()
    {
        return [
            'features' => FeatureResource::collection($this->service->get())
        ];
    }
}
