<?php

namespace Domain\Shared\Concerns;

use Illuminate\Database\Eloquent\Collection;

trait HasTags
{
    public function tags(): Collection
    {
        return Tag::all()->map->getData();
    }
}
