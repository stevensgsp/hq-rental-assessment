<?php

namespace App\ValueObjects;

class ProductPrice
{
    public function __construct(
        public int $original,
        public int $final,
        public ?string $discountPercentage,
        public string $currency = 'EUR',
    ) {
        //
    }
}
