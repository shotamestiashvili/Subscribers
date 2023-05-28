<?php

namespace App\Data;

use Spatie\LaravelData\Attributes\Validation\IntegerType;
use Spatie\LaravelData\Attributes\Validation\Numeric;
use Spatie\LaravelData\Attributes\Validation\StringType;
use Spatie\LaravelData\Data;
use Symfony\Contracts\Service\Attribute\Required;

class UserData extends Data
{
    public function __construct(
        #[Required]
        public int $id,
        public string  $name,
        #[StringType]
        public string $email,
    ){}
}
