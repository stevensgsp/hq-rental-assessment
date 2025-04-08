<?php

namespace App\Services\Product\PriceDiscountRules;

use App\Models\Product;
use App\Services\Product\PriceDiscountRules\Contracts\PriceDiscountContract;

class CategoryDiscountRule implements PriceDiscountContract
{
    /**
     * {@inheritDoc}
     */
    public function apply(Product $product): ?int
    {
        // Products in the "insurance" category have a 30% discount.
        if ($product->category?->name === 'insurance') {
            return 30;
        }

        return null;
    }
}
