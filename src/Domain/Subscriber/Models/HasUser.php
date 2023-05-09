<?php

namespace Domain\Subscriber\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Shared\Models\User;
use Domain\Subscriber\Models\UserScope;

trait HasUser
{
    public function user(): BelongsTo
    {
        return $this->BelongsTo(User::class);
    }

    public static function booted()
    {
        static::addGlobalScope(new UserScope());
    }
}
