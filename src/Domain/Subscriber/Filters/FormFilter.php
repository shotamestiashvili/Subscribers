<?php

namespace Domain\Subscriber\Filters;

use Illuminate\Database\Query\Builder;

class FormFilter
{
    public function __construct(protected readonly array $id){}

    public function filter(Builder $subscribers): Builder
    {
        if (count($this->ids) === 0) {
            return $subscribers;
        }

        return $subscribers->whereIn('form_id', $this->ids);
    }

    public function handle(
        Builder $subscribers,
        \Closure $next,
    ): Builder {
        if (count($this->ids) === 0) {
            return next($subscribers);
        }
        $subscribers->whereHas('form_id',  $this->ids);

        return next($subscribers);
    }
}
