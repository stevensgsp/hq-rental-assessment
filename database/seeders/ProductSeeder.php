<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $insuranceId = DB::table('categories')->where('name', 'insurance')->get()->first()?->id;
        $vehicleId = DB::table('categories')->where('name', 'vehicle')->get()->first()?->id;

        DB::table('products')->insert([
            'sku' => '000001',
            'name' => 'Full coverage insurance',
            'category_id' => $insuranceId,
            'price' => 89000,
        ]);

        DB::table('products')->insert([
            'sku' => '000002',
            'name' => 'Compact Car X3',
            'category_id' => $vehicleId,
            'price' => 99000,
        ]);

        DB::table('products')->insert([
            'sku' => '000003',
            'name' => 'SUV Vehicle, high end',
            'category_id' => $vehicleId,
            'price' => 150000,
        ]);

        DB::table('products')->insert([
            'sku' => '000004',
            'name' => 'Basic coverage',
            'category_id' => $insuranceId,
            'price' => 20000,
        ]);

        DB::table('products')->insert([
            'sku' => '000005',
            'name' => 'Convertible X2, Electric',
            'category_id' => $vehicleId,
            'price' => 250000,
        ]);
    }
}
