<?php

namespace Domain\Subscriber\Models;

use Domain\Mail\DataTransferObjects\FilterData;
use Domain\Subscriber\Enums\Filters;
use Illuminate\Database\Query\Builder;
use Illuminate\Routing\Pipeline;
use Illuminate\Support\Collection;

trait HasAudience
{
    abstract public function filters(): FilterData;
    abstract protected function audienceQuery(): Builder;

    public function audience(): Collection
    {
        $filters = collect($this->filters()->toArray())
            ->map(fn(array $ids, string $key) => Filters::from($key)->createFilter($ids)
            )
            ->values()
            ->all();
        return app(Pipeline::class)
            ->send($this->audienceQuery())
            ->through($filters)
            ->thenReturn()
            ->get();
    }
}
