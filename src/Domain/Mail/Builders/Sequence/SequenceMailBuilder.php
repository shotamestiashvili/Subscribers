<?php

namespace Domain\Mail\Builders\Sequence;

use Illuminate\Database\Query\Builder;

class SequenceMailBuilder extends Builder
{
    public function wherePublished(): self
    {
        return $this->whereStatus(SequenceMailStatus::Published);
    }
}
