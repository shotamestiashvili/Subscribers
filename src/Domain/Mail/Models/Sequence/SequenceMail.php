<?php

namespace Domain\Mail\Models\Sequence;

use Domain\Mail\Contracts\Sendable;
use Domain\Mail\DataTransferObjects\FilterData;
use Domain\Shared\Models\BaseModel;
use Domain\Subscriber\Models\Subscriber;
use Illuminate\Database\Query\Builder;
use Illuminate\Routing\Pipeline;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

class SequenceMail extends BaseModel implements Sendable
{
    public function shouldSendToday(): bool
    {
        $dayName = Str::lower(now()->dayName);
        return $this->schedule->allowed_days->{$dayName};
    }

    public function enoughTimePassedSince(SentMail $mail): bool
    {
        return $this->schedule->unit
                ->timePassedSince($mail->sent_at) >= $this->schedule->delay;
    }

    public function filters(): FilterData
    {
        return $this->filters;
    }

    public static function execute(Sendable $mail): Collection
    {
        $subscribers = Subscriber::query();

        if ($mail instanceof SequenceMail) {
            $subscribers = Subscriber::query()
                ->whereIn(
                    'id', $mail->sequence
                    ->subscribers()
                    ->select('subscribers.id')
                    ->pluck('id')
                );
        }

        return (new Pipeline())
            ->send($subscribers)
            ->through(self::filters($mail))
            ->thenReturn()
            ->get();
    }

    protected function audienceQuery(): Builder
    {
        return Subscriber::whereIn('id', $this->sequence->subscribers()
                ->select('subscribers.id')->pluck('id')
        );
    }
}
