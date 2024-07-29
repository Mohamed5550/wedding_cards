<?php

namespace App\Models;

use App\Models\WeddingCardFont;
use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class WeddingCard extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $fillable = [
        'has_families',
        'families_font_id',
        'families_font_size',
        'families_font_weight',
        'families_color',
        'groom_family_position_x',
        'groom_family_position_y',
        'bride_family_position_x',
        'bride_family_position_y',
        'names_font_id',
        'names_font_size',
        'names_font_weight',
        'names_color',
        'names_position_x',
        'names_position_y',
        'has_time_location',
        'time_location_font_id',
        'time_location_font_size',
        'time_location_font_weight',
        'time_location_color',
        'time_position_x',
        'time_position_y',
        'location_position_x',
        'location_position_y',
        'date_position_x',
        'date_position_y',
        'has_invitee',
        'invitee_font_id',
        'invitee_font_size',
        'invitee_font_weight',
        'invitee_color',
        'invitee_prefix',
        'invitee_x',
        'invitee_y',
        'qr_position_x',
        'qr_position_y',
    ];

    public function getImageAttribute()
    {
        return $this->getFirstMediaUrl('card_images');
    }

    public function familiesFont()
    {
        return $this->belongsTo(WeddingCardFont::class, 'families_font_id');
    }
    
    public function namesFont()
    {
        return $this->belongsTo(WeddingCardFont::class, 'names_font_id');
    }
    
    public function timeLocationFont()
    {
        return $this->belongsTo(WeddingCardFont::class, 'time_location_font_id');
    }
    
    public function inviteeFont()
    {
        return $this->belongsTo(WeddingCardFont::class, 'invitee_font_id');
    }
    
}
