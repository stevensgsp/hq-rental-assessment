<?php

namespace App\Http\Resources;

use App\Services\Product\PriceDiscountService;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        /**
         * @var \App\Models\Product
         */
        $product = $this->resource;

        $price = app(PriceDiscountService::class)->getPriceWithDiscount($product);

        return [
            'sku' => $this->sku,
            'name' => $this->name,
            'category' => $this->category?->name,
            'price' => new PriceResource($price),
        ];
    }
}
