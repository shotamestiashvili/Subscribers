<?php

namespace Domain\Mail\Contracts;

use Domain\Mail\DataTransferObjects\FilterData;
use Illuminate\Database\Query\Builder;

interface Sendable
{
    public function id(): int;
    public function subject(): string;
    public function content(): string;
    public function type(): string;
}
