<?php

namespace Domain\Mail\DataTransferObjects;

use Domain\Shared\ValueObject\Percent;
use Spatie\LaravelData\Data;

class PerformanceData extends Data
{
    public function __construct(
        public readonly int $total,
        public readonly Percent $open_rate,
        public readonly Percent $click_rate,
    ){}
}
