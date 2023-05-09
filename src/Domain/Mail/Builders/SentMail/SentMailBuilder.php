<?php

namespace Domain\Mail\Builders\SentMail;

use Domain\Mail\Contracts\Sendable;
use Domain\Shared\ValueObject\Percent;
use Illuminate\Database\Query\Builder;

class SentMailBuilder extends Builder
{
    public function whereSendable(Sendable $sendable): self
    {
        return $this
            ->where('sendable_id', $sendable->id())
            ->where('sendable_type', $sendable->type());
    }

    public function whereOpened(): self
    {
        return $this->whereNotNull('opened_at');
    }

    public function whereClicked(): self
    {
        return $this->whereNotNull('clicked_at');
    }

    public function countOf(Sendable $sendable): int
    {
        return $this->whereSendable($sendable)->count();
    }

    public function openRate(Sendable $sendable, int $total): Percent
    {
        $openedCount = $this
            ->whereSendable($sendable)
            ->whereOpened()
            ->count();

        return Percent::from($openedCount, $total);
    }

    public function clickRate(Sendable $sendable, int $total): Percent
    {
        $clickRate = $this
            ->whereSendable($sendable)
            ->whereClicked()
            ->count();

        return Percent::from($clickRate, $total);
    }
}
