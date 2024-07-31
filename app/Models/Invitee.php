<?php

namespace App\Models;

use App\Models\Event;
use ArPHP\I18N\Arabic;
use Intervention\Image\Image;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use App\Notifications\WhatsAppInvitation;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Intervention\Image\Laravel\Facades\Image as ImageFacade;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Invitee extends Model implements HasMedia
{
    use HasFactory, Notifiable, InteractsWithMedia;
    public Image $weddingCardImage;
    protected Arabic $arabicGlyphs;

    const PENDING = 'pending';
    const SENT = 'sent';
    const FAILED = 'failed';

    const ATTENDED = 'attended';
    const NOT_ATTENDED = 'not_attended';

    protected $fillable = [
        'event_id',
        'name',
        'phone',
        'status',
        'attendance_status',
        'qr_token'
    ];

    public function getInviteCardAttribute()
    {
        return $this->getFirstMediaUrl('invite_cards');
    }

    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    public function getCardSrcAttribute()
    {
        $this->createInviteeWeddingCard();

        $this->saveInviteeWeddingCard();

        return $this->inviteCard;
    }

    public function scopePending($query)
    {
        return $query->where('status', self::PENDING);
    }

    public function sendInvite()
    {
        $this->notify(new WhatsAppInvitation());
        $this->update(['status' => self::SENT]);
    }

    public function routeNotificationForWhatsApp()
    {
        return $this->phone;
    }

    public function createInviteeWeddingCard()
    {
        $this->event->createCustomWeddingCard();
        $this->weddingCardImage = $this->event->customWeddingCard;
        $this->arabicGlyphs = new Arabic('Glyphs');
        
        $this->addInviteeNameToCard();
        $this->addInviteeQrCodeToCard();
    }

    protected function addInviteeNameToCard()
    {
        if(!$this->event->weddingCard->has_invitee) return;

        $interventionText = new InterventionText(
            position_x: $this->event->weddingCard->invitee_x,
            position_y: $this->event->weddingCard->invitee_y,
            text: $this->arabicGlyphs->utf8Glyphs($this->event->weddingCard->invitee_prefix . " " . $this->name),
            font_path: $this->event->weddingCard->inviteeFont->getFirstMediaPath('fonts'),
            font_size: $this->event->weddingCard->invitee_font_size,
            color: $this->event->weddingCard->invitee_color,
        );

        $interventionText->applyTextToImage($this->weddingCardImage);
    }

    protected function addInviteeQrCodeToCard()
    {
        $qrCode = QrCode::format('png')->size(250)->generate($this->qr_token);

        dd($qrCode);
        $this->weddingCardImage->place($qrCode, 'center', $this->event->weddingCard->qr_position_x, $this->event->weddingCard->qr_position_x);
    }

    protected function saveInviteeWeddingCard()
    {
        $fileName = 'event_' . $this->event_id . '-card_' . $this->id . '.jpg';
        $this->addMediaFromString($this->weddingCardImage->toJpeg(90))
            ->usingFileName($fileName)
            ->toMediaCollection('invite_cards');
    }
}
