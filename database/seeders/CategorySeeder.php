<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    public function run()
    {
        $categories = [
            ['name' => 'Clothing', 'slug' => Str::slug('Clothing'), 'image' => 'categories/clothing.jpg', 'status' => 1, 'showHome' => 'Yes', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Electronics', 'slug' => Str::slug('Electronics'), 'image' => 'categories/electronics.jpg', 'status' => 1, 'showHome' => 'Yes', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Grocery & Daily Needs', 'slug' => Str::slug('Grocery & Daily Needs'), 'image' => 'categories/grocery.jpg', 'status' => 1, 'showHome' => 'Yes', 'created_at' => now(), 'updated_at' => now()],

            // NEW CATEGORIES
            ['name' => 'Home & Living', 'slug' => Str::slug('Home & Living'), 'image' => 'categories/home.jpg', 'status' => 1, 'showHome' => 'No', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Beauty & Personal Care', 'slug' => Str::slug('Beauty & Personal Care'), 'image' => 'categories/beauty.jpg', 'status' => 1, 'showHome' => 'No', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Sports & Outdoor', 'slug' => Str::slug('Sports & Outdoor'), 'image' => 'categories/sports.jpg', 'status' => 1, 'showHome' => 'No', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Baby Products', 'slug' => Str::slug('Baby Products'), 'image' => 'categories/baby.jpg', 'status' => 1, 'showHome' => 'No', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Computer Accessories', 'slug' => Str::slug('Computer Accessories'), 'image' => 'categories/computer.jpg', 'status' => 1, 'showHome' => 'No', 'created_at' => now(), 'updated_at' => now()],
        ];

        DB::table('categories')->insert($categories);
    }
}
