<?php

namespace App\Services\Product;

use App\Models\Product;
use App\Services\Product\PriceDiscountRules\CategoryDiscountRule;
use App\Services\Product\PriceDiscountRules\SkuDiscountRule;
use App\ValueObjects\ProductPrice;

class PriceDiscountService
{
    /**
     * The different rules to apply a discount over a product.
     *
     * @var array<int,string>
     */
    public array $ruleClasses = [
        CategoryDiscountRule::class,
        SkuDiscountRule::class,
    ];

    /**
     * Returns a ProductPrice object containing the discounted price indormation.
     *
     * @param \App\Models\Product $product
     * @return \App\ValueObjects\ProductPrice
     */
    public function getPriceWithDiscount(Product $product): ProductPrice
    {
        $original = $product->price;

        $discountPercentage = $this->getDiscountPercentage($product);
        $discount = $original * ($discountPercentage / 100);
        $final = $original - $discount;

        $readableDiscountPercentage = ! is_null($discountPercentage) ? $discountPercentage . '%' : null;

        return new ProductPrice(
            $original,
            $final,
            $readableDiscountPercentage
        );
    }

    /**
     * @param \App\Models\Product $product
     * @return int|null
     */
    protected function getDiscountPercentage(Product $product): ?int
    {
        foreach ($this->ruleClasses as $ruleClass) {
            /**
             * @var \App\Services\Product\PriceDiscountRules\Contracts\PriceDiscountContract
             */
            $rule = app($ruleClass);

            $discount = $rule->apply($product);

            // Only apply the first rule that matches
            if (! is_null($discount)) {
                return $discount;
            }
        }

        return null;
    }
}
