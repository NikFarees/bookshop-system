<?php

namespace Database\Seeders;

use App\Models\VendorProduct;
use App\Models\Organization;
use App\Models\Product;
use Illuminate\Database\Seeder;

class VendorProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get the vendor organization
        $vendor = Organization::where('type', 'vendor')->first();

        // Get all products
        $products = Product::all();

        $vendorProductsData = [
            'BM-D4-2024' => ['price' => 25.90, 'sku' => 'EDU-BM-D4-001', 'stock' => 100],
            'BI-D4-2024' => ['price' => 28.50, 'sku' => 'EDU-BI-D4-001', 'stock' => 85],
            'MATH-D4-2024' => ['price' => 22.90, 'sku' => 'EDU-MATH-D4-001', 'stock' => 120],
            'SCI-D4-2024' => ['price' => 24.90, 'sku' => 'EDU-SCI-D4-001', 'stock' => 95],
            'PEN-BLUE-PILOT' => ['price' => 2.50, 'sku' => 'EDU-PEN-PILOT-001', 'stock' => 500],
            'PENCIL-2B-FABER' => ['price' => 1.80, 'sku' => 'EDU-PENCIL-FABER-001', 'stock' => 300],
            'ERASER-WHITE' => ['price' => 1.20, 'sku' => 'EDU-ERASER-001', 'stock' => 200],
            'RULER-30CM' => ['price' => 3.50, 'sku' => 'EDU-RULER-001', 'stock' => 150],
            'NOTEBOOK-A4-120' => ['price' => 4.90, 'sku' => 'EDU-NOTEBOOK-001', 'stock' => 400],
            'SCHOOLBAG-NAVY' => ['price' => 45.00, 'sku' => 'EDU-BAG-001', 'stock' => 25],
        ];

        foreach ($products as $product) {
            if (isset($vendorProductsData[$product->code])) {
                $data = $vendorProductsData[$product->code];

                VendorProduct::create([
                    'vendor_id' => $vendor->id,
                    'product_id' => $product->id,
                    'sku' => $data['sku'],
                    'default_price' => $data['price'],
                    'stock_qty' => $data['stock'],
                    'min_stock_qty' => 10,
                    'status' => 'active',
                ]);
            }
        }
    }
}