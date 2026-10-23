<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            ['name' => 'iPhone 17 Pro Max', 'description' => 'Bản 256GB, chip A19 Pro', 'price' => 34990000, 'stock' => 10],
            ['name' => 'Samsung Galaxy S26 Ultra', 'description' => 'Bản 512GB, camera 200MP', 'price' => 31990000, 'stock' => 8],
            ['name' => 'Xiaomi 15T Pro', 'description' => 'Bản 256GB, sạc nhanh 120W', 'price' => 14990000, 'stock' => 15],
            ['name' => 'OPPO Find X9', 'description' => 'Bản 256GB, camera Hasselblad', 'price' => 22990000, 'stock' => 5],
        ];

        foreach ($products as $product) {
            Product::updateOrCreate($product);
        }
    }
}