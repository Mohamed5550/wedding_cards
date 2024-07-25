<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\HomeImageService;
use App\Http\Resources\HomeImageResource;

class HomeImageController extends Controller
{
    protected $service = HomeImageService::class;

    public function index()
    {
        return [
            'home_images' => HomeImageResource::collection($this->service->get())
        ];
    }
}
