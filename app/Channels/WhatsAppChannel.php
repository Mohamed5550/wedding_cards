<?php
namespace App\Channels;

use App\Notifications\WhatsAppInvitation;
use Twilio\Rest\Client;

class WhatsAppChannel
{
    public function send($notifiable, WhatsAppInvitation $notification)
    {
        $message = $notification->toWhatsApp($notifiable);


        $to = $notifiable->routeNotificationFor('WhatsApp');
        $from = config('services.twilio.whatsapp_from');


        $twilio = new Client(config('services.twilio.sid'), config('services.twilio.token'));

        return $twilio->messages->create('whatsapp:' . $to, [
            "from" => 'whatsapp:' . $from,
            "body" => $message->body,
            "mediaUrl" => [$message->mediaUrl]
        ]);
    }
}