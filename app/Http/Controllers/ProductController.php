<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductResource;
use App\Models\Product;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\Enums\FilterOperator;
use Spatie\QueryBuilder\QueryBuilder;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        $products = QueryBuilder::for(Product::class)
            ->with(['category'])
            ->allowedFilters([
                AllowedFilter::exact('category_id'),
                AllowedFilter::exact('category', 'category.name'),
                AllowedFilter::operator('price', FilterOperator::DYNAMIC)
            ])
            ->get();

        return ProductResource::collection($products);
    }
}
