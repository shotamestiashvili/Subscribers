<?php

namespace Domain\Mail\Actions;

use Domain\Mail\Contracts\Sendable;
use Domain\Mail\DataTransferObjects\PerformanceData;

class GetPerformanceAction
{
    public static function execute(
        Sendable $sendable, $total
    ): PerformanceData
    {
        return new PerformanceData(
            total: SentMail::countOf($sendable),
            open_rate: SentMail::openRate($sendable, $total),
            click_rate: SentMail::clickRate($sendable, $total),
        );
    }
}
