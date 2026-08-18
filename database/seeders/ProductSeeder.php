<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            ['name' => 'Wireless Mouse', 'description' => 'Ergonomic 2.4GHz wireless mouse', 'price' => 15.99],
            ['name' => 'Mechanical Keyboard', 'description' => 'RGB backlit mechanical keyboard', 'price' => 49.99],
            ['name' => 'USB-C Hub', 'description' => '7-in-1 USB-C hub with HDMI', 'price' => 29.50],
            ['name' => 'Laptop Stand', 'description' => 'Adjustable aluminum laptop stand', 'price' => 22.00],
            ['name' => 'Webcam 1080p', 'description' => 'Full HD webcam with built-in mic', 'price' => 34.99],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
