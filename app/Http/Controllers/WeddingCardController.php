<?php

namespace App\Http\Controllers;

use App\Services\WeddingCardService;
use App\Http\Resources\WeddingCardResource;

class WeddingCardController extends Controller
{
    protected $service = WeddingCardService::class;

    public function index()
    {
        return [
            'home_images' => WeddingCardResource::collection($this->service->get())
        ];
    }
}
