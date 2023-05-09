<?php

namespace Domain\Subscriber\Filters;

use Illuminate\Database\Query\Builder;

abstract class Filter
{
    public function __construct(protected readonly array $ids){}

    abstract public function filter(Builder $subscribers): Builder;

    abstract public function handle(Builder $subscribers, \Closure $next): Builder;

}
