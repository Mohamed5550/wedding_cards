<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EventResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'time' => $this->time->format("Y-m-d H:i:s"),
            'location' => $this->location,
            'groom_family' => $this->groom_family,
            'groom_name' => $this->groom_name,
            'bride_family' => $this->bride_family,
            'bride_name' => $this->bride_name,
            'user_image' => $this->user->image,
            'status' => $this->status->label(),
            'status_key' => $this->status,
            'invites_count' => $this->invitees()->count(),
        ];
    }
}
