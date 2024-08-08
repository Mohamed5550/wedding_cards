<?php

namespace App\Models;

use App\Enums\InviteeAttendanceStatus;
use App\Enums\InviteeNotificationStatus;
use App\Models\Event;
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

    protected $fillable = [
        'event_id',
        'name',
        'phone',
        'status',
        'qr_token'
    ];

    protected $casts = [
        'time' => 'datetime',
        'status' => InviteeNotificationStatus::class,
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
        return $query->where('status', InviteeNotificationStatus::PENDING);
    }

    public function scopeFailed($query)
    {
        return $query->where('status', InviteeNotificationStatus::FAILED);
    }
    
    public function scopeSent($query)
    {
        return $query->where('status', InviteeNotificationStatus::SENT);
    }

    public function scopeAttended($query)
    {
        return $query->whereNotNull('attended_at');
    }

    public function scopeNotAttended($query)
    {
        return $query->whereNull('attended_at');
    }

    public function sendInvite()
    {
        try {
            $this->notify(new WhatsAppInvitation());
            $this->update(['status' => InviteeNotificationStatus::SENT]);
        } catch (\Exception $e) {
            $this->update(['status' => InviteeNotificationStatus::FAILED]);
        }
    }

    public function routeNotificationForWhatsApp()
    {
        return $this->phone;
    }

    public function createInviteeWeddingCard()
    {
        $this->event->createCustomWeddingCard();
        $this->weddingCardImage = $this->event->customWeddingCard;
        
        $this->addInviteeNameToCard();
        $this->addInviteeQrCodeToCard();
    }

    protected function addInviteeNameToCard()
    {
        if(!$this->event->weddingCard->has_invitee) return;

        $interventionText = new InterventionText(
            position_x: $this->event->weddingCard->invitee_x,
            position_y: $this->event->weddingCard->invitee_y,
            text: $this->event->weddingCard->invitee_prefix . " " . $this->name,
            font_path: $this->event->weddingCard->inviteeFont->getFirstMediaPath('fonts'),
            font_size: $this->event->weddingCard->invitee_font_size,
            color: $this->event->weddingCard->invitee_color,
        );

        $interventionText->applyTextToImage($this->weddingCardImage);
    }

    protected function addInviteeQrCodeToCard()
    {
        $qrCode = QrCode::format('png')->size(180)->generate($this->qr_token);

        $qrCodeImage = ImageFacade::read($qrCode->toHTML());

        $this->weddingCardImage->place($qrCodeImage, 'top-left', $this->event->weddingCard->qr_position_x, $this->event->weddingCard->qr_position_y);
    }

    protected function saveInviteeWeddingCard()
    {
        $fileName = 'event_' . $this->event_id . '-card_' . $this->id . '.jpg';
        $this->addMediaFromString($this->weddingCardImage->toJpeg(90))
            ->usingFileName($fileName)
            ->toMediaCollection('invite_cards');
    }
}
