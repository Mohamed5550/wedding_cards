<?php

namespace App\Http\Resources;

use App\Models\HomeImage;
use Illuminate\Http\Request;
use App\Http\Resources\HomeImageResource;
use Illuminate\Http\Resources\Json\JsonResource;

class HomeDataResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'home_title' => setting('home.title'),
            'home_subtitle' => setting('home.subtitle'),
            'home_background' => asset('storage/' . setting('home.background')),
            'home_why_text' => setting('home.why_choose_us_text'),
            'home_images' => HomeImageResource::collection(HomeImage::get()),
        ];
    }
}
