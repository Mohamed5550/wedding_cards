<?php

namespace App\Models;

use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class HomeImage extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;
    
    public function getImageAttribute()
    {
        return $this->getFirstMediaUrl('home_images');
    }
}
