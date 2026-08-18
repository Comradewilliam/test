<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            ['name' => 'Wireless Mouse', 'description' => 'Ergonomic 2.4GHz wireless mouse with adjustable DPI', 'price' => 19.99],
            ['name' => 'Mechanical Keyboard', 'description' => 'RGB backlit mechanical keyboard with hot-swappable switches', 'price' => 59.99],
            ['name' => 'USB-C Hub', 'description' => '7-in-1 multi-port USB-C adapter with 4K HDMI and Power Delivery', 'price' => 29.50],
            ['name' => 'Laptop Stand', 'description' => 'Foldable aluminum laptop stand for ergonomic cooling', 'price' => 24.99],
            ['name' => 'Webcam 1080p', 'description' => 'Full HD streaming webcam with dual noise-cancelling microphones', 'price' => 39.99],
            ['name' => 'Noise Cancelling Headphones', 'description' => 'Over-ear Bluetooth headphones with active noise cancellation', 'price' => 79.99],
            ['name' => '27-inch 4K Monitor', 'description' => 'Ultra HD IPS monitor with HDR10 and ultra-thin bezels', 'price' => 299.99],
            ['name' => 'Ergonomic Office Chair', 'description' => 'Breathable mesh desk chair with adjustable lumbar support', 'price' => 149.00],
            ['name' => 'Portable SSD 1TB', 'description' => 'High-speed NVMe portable solid state drive up to 1050MB/s', 'price' => 89.50],
            ['name' => 'Desk Mat XXL', 'description' => 'Waterproof extended gaming mouse pad and desk protector', 'price' => 15.00],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
