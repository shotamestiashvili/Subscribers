<?php

namespace Domain\Mail\Models\Broadcast;

use Domain\Mail\Builders\Broadcast\BroadcastBuilder;
use Domain\Mail\Contracts\Sendable;
use Domain\Mail\DataTransferObjects\Broadcast\BroadcastData;
use Domain\Mail\DataTransferObjects\FilterData;
use Domain\Mail\Enums\Broadcast\BroadcastStatus;
use Domain\Mail\Models\FiltersCast;
use Domain\Shared\Models\BaseModel;
use Domain\Subscriber\Models\HasUser;
use Domain\Subscriber\Models\Subscriber;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Query\Builder;
use Spatie\LaravelData\WithData;

class Broadcast extends BaseModel implements Sendable
{
    use WithData;
    use HasUser;

    protected $dataClass = BroadcastData::class;

    protected $casts = [
        'filters' => FiltersCast::class,
        'status' => BroadcastStatus::class,
    ];

    protected $attributes = [
        'status' => BroadcastStatus::Draft,
    ];

    protected function audienceQuery(): Builder
    {
        return Subscriber::query();
    }

    public function newElouqentBuilder($query): BroadcastBuilder
    {
        return new BroadcastBuilder($query);
    }

    public function sent_mails(): MorphMany
    {
        return $this->morphMany(SentMail::class, 'sendable');
    }

    public function id(): int
    {
        return $this->id;
    }

    public function type(): string
    {
        return $this::class;
    }

    public function filters(): FilterData
    {
        return $this->filters;
    }
}
