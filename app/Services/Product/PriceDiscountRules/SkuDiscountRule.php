<?php

namespace App\Services\Product\PriceDiscountRules;

use App\Models\Product;
use App\Services\Product\PriceDiscountRules\Contracts\PriceDiscountContract;

class SkuDiscountRule implements PriceDiscountContract
{
    /**
     * {@inheritDoc}
     */
    public function apply(Product $product): ?int
    {
        // The product with sku = 000003 has a 15% discount.
        if ($product->sku === '000003') {
            return 15;
        }

        return null;
    }
}
