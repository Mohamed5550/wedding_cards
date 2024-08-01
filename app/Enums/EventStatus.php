<?php

namespace App\Enums;

enum EventStatus: string
{
    case NOT_STARTED = 'not_started';
    case IN_PROGRESS = 'in_progress';
    case Finished = 'finished';

    public function label(): string
    {
        return match($this)
        {
            self::NOT_STARTED => 'Not Started',
            self::IN_PROGRESS => 'In Progress',
            self::Finished => 'Finished'
        };
    }
}