<?php

namespace App\Http\Resources;

use App\Models\Event;
use App\Models\WeddingCard;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProfileResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'latest_events' => EventResource::collection(Event::latest()->limit(3)->get()),
            'latest_designs' => WeddingCardResource::collection(WeddingCard::latest()->limit(10)->get()),
            'your_events' => EventResource::collection(auth()->user()->events),
        ];
    }
}
