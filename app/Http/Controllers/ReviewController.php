<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ReviewService;
use App\Http\Resources\ReviewResource;

class ReviewController extends Controller
{
    protected $service = ReviewService::class;

    public function index()
    {
        return [
            'reviews' => ReviewResource::collection($this->service->get())
        ];
    }
}
