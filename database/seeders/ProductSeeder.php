<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            // Books
            [
                'code' => 'BM-D4-2024',
                'name' => 'Buku Teks Bahasa Melayu Darjah 4',
                'type' => 'book',
                'brand' => 'Dewan Bahasa dan Pustaka',
                'uom' => 'unit',
                'status' => 'active',
            ],
            [
                'code' => 'BI-D4-2024',
                'name' => 'English Textbook Year 4',
                'type' => 'book',
                'brand' => 'Oxford University Press',
                'uom' => 'unit',
                'status' => 'active',
            ],
            [
                'code' => 'MATH-D4-2024',
                'name' => 'Matematik Darjah 4',
                'type' => 'book',
                'brand' => 'Pelangi Publications',
                'uom' => 'unit',
                'status' => 'active',
            ],
            [
                'code' => 'SCI-D4-2024',
                'name' => 'Sains Darjah 4',
                'type' => 'book',
                'brand' => 'Longman Pearson',
                'uom' => 'unit',
                'status' => 'active',
            ],

            // Stationery
            [
                'code' => 'PEN-BLUE-PILOT',
                'name' => 'Pilot Blue Ballpoint Pen',
                'type' => 'stationery',
                'brand' => 'Pilot',
                'uom' => 'unit',
                'status' => 'active',
            ],
            [
                'code' => 'PENCIL-2B-FABER',
                'name' => 'Faber Castell 2B Pencil',
                'type' => 'stationery',
                'brand' => 'Faber Castell',
                'uom' => 'unit',
                'status' => 'active',
            ],
            [
                'code' => 'ERASER-WHITE',
                'name' => 'White Eraser',
                'type' => 'stationery',
                'brand' => 'Steadtler',
                'uom' => 'unit',
                'status' => 'active',
            ],
            [
                'code' => 'RULER-30CM',
                'name' => '30cm Plastic Ruler',
                'type' => 'stationery',
                'brand' => 'Generic',
                'uom' => 'unit',
                'status' => 'active',
            ],
            [
                'code' => 'NOTEBOOK-A4-120',
                'name' => 'A4 Exercise Book 120 Pages',
                'type' => 'stationery',
                'brand' => 'Campus',
                'uom' => 'unit',
                'status' => 'active',
            ],
            [
                'code' => 'SCHOOLBAG-NAVY',
                'name' => 'Navy Blue School Bag',
                'type' => 'other',
                'brand' => 'Herschel',
                'uom' => 'unit',
                'status' => 'active',
            ],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}