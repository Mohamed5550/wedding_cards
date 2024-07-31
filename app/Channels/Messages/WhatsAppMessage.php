<?php


namespace App\Channels\Messages;

class WhatsAppMessage
{
  public $body;
  public $mediaUrl;
  
  public function body($body)
  {
    $this->body = $body;
    
    return $this;
  }
  
  public function mediaUrl($mediaUrl)
  {
    $this->mediaUrl = $mediaUrl;

    return $this;
  }
}