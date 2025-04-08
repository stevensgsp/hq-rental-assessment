<?php

namespace App\Services\Product\PriceDiscountRules\Contracts;

use App\Models\Product;

interface PriceDiscountContract
{
    /**
     * Defines the rule to apply the discount over the product.
     *
     * Returns the discount percentage as an interger, representing the
     * percentage. For instance: 30.
     *
     * Returns null in case the product does not have discount.
     *
     * @param \App\Models\Product $product
     * @return int|null
     */
    public function apply(Product $product): ?int;
}
