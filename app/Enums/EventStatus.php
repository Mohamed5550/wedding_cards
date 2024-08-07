<?php

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasLabel;

enum EventStatus: string implements HasLabel, HasColor
{
    case NOT_STARTED = 'not_started';
    case IN_PROGRESS = 'in_progress';
    case FINISHED = 'finished';

    public function label(): string
    {
        return match($this)
        {
            self::NOT_STARTED => __("Not Started"),
            self::IN_PROGRESS => __("In Progress"),
            self::FINISHED => __("Finished")
        };
    }

    public function getLabel(): ?string
    {
        return match($this)
        {
            self::NOT_STARTED => __("Not Started"),
            self::IN_PROGRESS => __("In Progress"),
            self::FINISHED => __("Finished")
        };
    }

    public function getColor(): string | array | null
    {
        return match ($this) {
            self::NOT_STARTED => 'gray',
            self::IN_PROGRESS => 'warning',
            self::FINISHED => 'success'
        };
    }
}