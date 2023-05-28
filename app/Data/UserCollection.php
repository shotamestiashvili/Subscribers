<?php

namespace App\Data;

use Domain\Shared\Models\User;
use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\DataCollection;

class UserCollection extends Data
{
    public function __construct(
        #[DataCollectionOf(User::class)]
        public DataCollection $users
    ){}

}
