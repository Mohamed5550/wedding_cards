<?php

namespace App\Http\Resources;

use App\Models\HomeImage;
use Illuminate\Http\Request;
use App\Http\Resources\HomeImageResource;
use Illuminate\Http\Resources\Json\JsonResource;

class SettingsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'app_name' => setting('general.app_name'),
            'app_description' => setting('general.app_description'),
            'app_logo' => asset('storage/' . setting('general.app_logo')),
            'excel_template_link' => asset('storage/' . setting('general.excel_template'))
        ];
    }
}
