<?php

namespace Domain\Shared\Concerns;

use Illuminate\Database\Eloquent\Collection;

trait HasForms
{
    public function forms(): Collection
    {
        return Form::all()->map->getData();
    }
}
