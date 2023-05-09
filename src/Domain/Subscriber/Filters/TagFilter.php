<?php

namespace Domain\Subscriber\Filters;

use Illuminate\Database\Query\Builder;

class TagFilter
{
    public function __construct(protected readonly array $ids)
    {
    }

    public function filter(Builder $subscriber): Builder
    {
        if (count($this->ids) === 0) {
            return $subscriber;
        }

        return $subscriber->whereHas('tags', fn(Builder $tags) =>
                     $tags->whereIn('id', $this->ids));
    }

    public function handle(
        Builder $subscribers,
        \Closure $next,
    ): Builder {
        if (count($this->ids) === 0) {
            return next($subscribers);
        }
        $subscribers->whereHas('tags', fn(Builder $tags) =>
        $tags->whereIn('id', $this->ids));

        return next($subscribers);
    }
}


