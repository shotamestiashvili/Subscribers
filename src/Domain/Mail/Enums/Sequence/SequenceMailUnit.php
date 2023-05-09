<?php

namespace Domain\Mail\Enums\Sequence;

use Carbon\Carbon;

enum SequenceMailUnit: string
{
    case Day = 'day';
    case Hour = 'hour';

    public function timePassedSince(Carbon $date): int
    {
        return match($this) {
            self::Day => now()->diffInDays($date),
            self::Hour => now()->diffInHours($date),
        };
    }
}
