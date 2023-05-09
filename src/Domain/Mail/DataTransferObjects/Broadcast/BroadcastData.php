<?php

namespace Domain\Mail\DataTransferObjects\Broadcast;

use Carbon\Carbon;
use Spatie\LaravelData\Data;

class BroadcastData extends Data
{
    public function __construct(
        public readonly ?int $id,
        public readonly string $subject,
        public readonly string $content,
        public readonly ?FilterData $filter,
        public readonly ?Carbon $sent_at,
       #[WithCast(EnumCast::class)]
       public readonly ?BroadcastStatus $status = BroadcastStatus::Draft,

    ){}
}
