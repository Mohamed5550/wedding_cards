<?php

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasLabel;

enum InviteeNotificationStatus: string implements HasLabel, HasColor
{
    case PENDING = 'pending';
    case SENT = 'sent';
    case FAILED = 'failed';

    public function label(): string
    {
        return match($this)
        {
            self::PENDING => __("Pending"),
            self::SENT => __("Sent"),
            self::FAILED => __("Failed")
        };
    }

    public function getLabel(): ?string
    {
        return match($this)
        {
            self::PENDING => __("Pending"),
            self::SENT => __("Sent"),
            self::FAILED => __("Failed")
        };
    }

    public function getColor(): string | array | null
    {
        return match($this)
        {
            self::PENDING => 'gray',
            self::SENT => 'success',
            self::FAILED => 'danger'
        };
    }
}