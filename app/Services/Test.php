<?php

namespace App\Services;

use Spatie\LaravelData\Data;

class Test extends Data
{
    public function __construct(
        public string $name,
        public int $age
    ){}

    public static function fromMe(string $string): self
    {
        [$title, $artist] = explode('|', $string);

        return new self($title, $artist);
    }
}
