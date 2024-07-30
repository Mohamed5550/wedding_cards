<?php

namespace App\Models;

use Carbon\Carbon;
use ArPHP\I18N\Arabic;
use Intervention\Image\Image;
use Illuminate\Database\Eloquent\Model;
use Intervention\Image\Laravel\Facades\Image as ImageFacade;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Event extends Model
{
    use HasFactory;

    public Image $customWeddingCard;
    protected Arabic $arabicGlyphs;

    protected $casts = [
        'time' => 'datetime',
    ];

    protected $fillable = [
        'name',
        'wedding_card_id',
        'time',
        'location',
        'groom_family',
        'groom_name',
        'bride_family',
        'bride_name',
        'user_id',
    ];

    public function weddingCard()
    {
        return $this->belongsTo(WeddingCard::class);
    }

    public function createCustomWeddingCard()
    {
        $this->load('weddingCard');
        $this->customWeddingCard = ImageFacade::read($this->weddingCard->getFirstMediaPath('card_images'));
        $this->arabicGlyphs = new Arabic('Glyphs');

        $this->addFamiliesToCard();
        $this->addNamesToCard();
        $this->addTimeAndLocationToCard();

        // $this->saveCard();
    }

    protected function addFamiliesToCard()
    {
        $this->addGroomFamilyToCard();
        $this->addBrideFamilyToCard();
    }

    protected function addGroomFamilyToCard()
    {
        $interventionText = new InterventionText(
            position_x: $this->weddingCard->groom_family_position_x,
            position_y: $this->weddingCard->groom_family_position_y,
            text: $this->arabicGlyphs->utf8Glyphs($this->groom_family),
            font_path: $this->weddingCard->familiesFont->getFirstMediaPath('fonts'),
            font_size: $this->weddingCard->families_font_size,
            color: $this->weddingCard->families_color
        );

        $interventionText->applyTextToImage($this->customWeddingCard);
    }

    protected function addBrideFamilyToCard()
    {
        $interventionText = new InterventionText(
            position_x: $this->weddingCard->bride_family_position_x,
            position_y: $this->weddingCard->bride_family_position_y,
            text: $this->arabicGlyphs->utf8Glyphs($this->bride_family),
            font_path: $this->weddingCard->familiesFont->getFirstMediaPath('fonts'),
            font_size: $this->weddingCard->families_font_size,
            color: $this->weddingCard->families_color
        );

        $interventionText->applyTextToImage($this->customWeddingCard);
    }

    protected function addNamesToCard()
    {
        $interventionText = new InterventionText(
            position_x: $this->weddingCard->names_position_x,
            position_y: $this->weddingCard->names_position_y,
            text: $this->arabicGlyphs->utf8Glyphs($this->groom_name . ' و' . $this->bride_name),
            font_path: $this->weddingCard->namesFont->getFirstMediaPath('fonts'),
            font_size: $this->weddingCard->names_font_size,
            color: $this->weddingCard->names_color
        );

        $interventionText->applyTextToImage($this->customWeddingCard);
    }

    protected function addTimeAndLocationToCard()
    {
        $this->addTimeToCard();
        $this->addDateToCard();
        $this->addLocationToCard();
    }

    protected function addTimeToCard()
    {
        $interventionText = new InterventionText(
            position_x: $this->weddingCard->time_position_x,
            position_y: $this->weddingCard->time_position_y,
            text: $this->arabicGlyphs->utf8Glyphs($this->time->format('H:i') . ' ' . ($this->time->format('A') == 'AM' ? 'صباحًا' : 'مساءً')),
            font_path: $this->weddingCard->timeLocationFont->getFirstMediaPath('fonts'),
            font_size: $this->weddingCard->time_location_font_size,
            color: $this->weddingCard->time_location_color,
            wrap: 130
        );

        $interventionText->applyTextToImage($this->customWeddingCard);
    }

    protected function addDateToCard()
    {
        $interventionText = new InterventionText(
            position_x: $this->weddingCard->date_position_x,
            position_y: $this->weddingCard->date_position_y,
            text: $this->arabicGlyphs->utf8Glyphs($this->time->format('Y/m/d') . ' ' . $this->time->dayName),
            font_path: $this->weddingCard->timeLocationFont->getFirstMediaPath('fonts'),
            font_size: $this->weddingCard->time_location_font_size,
            color: $this->weddingCard->time_location_color,
            wrap: 186
        );

        $interventionText->applyTextToImage($this->customWeddingCard);
    }

    protected function addLocationToCard()
    {
        $interventionText = new InterventionText(
            position_x: $this->weddingCard->location_position_x,
            position_y: $this->weddingCard->location_position_y,
            text: $this->arabicGlyphs->utf8Glyphs($this->location),
            font_path: $this->weddingCard->timeLocationFont->getFirstMediaPath('fonts'),
            font_size: $this->weddingCard->time_location_font_size,
            color: $this->weddingCard->time_location_color,
            wrap: 220
        );

        $interventionText->applyTextToImage($this->customWeddingCard);
    }
}
