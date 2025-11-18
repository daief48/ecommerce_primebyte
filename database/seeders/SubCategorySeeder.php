<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class SubCategorySeeder extends Seeder
{
    public function run()
    {
        $sub = [

            // Clothing (ID:1)
            ['name' => 'Men Clothing', 'slug' => Str::slug('Men Clothing'), 'category_id' => 1, 'status' => 1, 'showHome' => 'Yes'],
            ['name' => 'Women Clothing', 'slug' => Str::slug('Women Clothing'), 'category_id' => 1, 'status' => 1, 'showHome' => 'Yes'],
            ['name' => 'Kid Fashion', 'slug' => Str::slug('Kid Fashion'), 'category_id' => 1, 'status' => 1, 'showHome' => 'No'],
            ['name' => 'Winter Wear', 'slug' => Str::slug('Winter Wear'), 'category_id' => 1, 'status' => 1, 'showHome' => 'No'],

            // Electronics (ID:2)
            ['name' => 'Smartphones', 'slug' => Str::slug('Smartphones'), 'category_id' => 2, 'status' => 1, 'showHome' => 'Yes'],
            ['name' => 'Laptops', 'slug' => Str::slug('Laptops'), 'category_id' => 2, 'status' => 1, 'showHome' => 'Yes'],
            ['name' => 'Smart Gadgets', 'slug' => Str::slug('Smart Gadgets'), 'category_id' => 2, 'status' => 1, 'showHome' => 'No'],
            ['name' => 'Televisions', 'slug' => Str::slug('Televisions'), 'category_id' => 2, 'status' => 1, 'showHome' => 'No'],
            ['name' => 'Headphones & Audio', 'slug' => Str::slug('Headphones & Audio'), 'category_id' => 2, 'status' => 1, 'showHome' => 'No'],

            // Grocery (ID:3)
            ['name' => 'Rice & Oil', 'slug' => Str::slug('Rice & Oil'), 'category_id' => 3, 'status' => 1, 'showHome' => 'Yes'],
            ['name' => 'Snacks & Beverages', 'slug' => Str::slug('Snacks & Beverages'), 'category_id' => 3, 'status' => 1, 'showHome' => 'Yes'],
            ['name' => 'Household Items', 'slug' => Str::slug('Household Items'), 'category_id' => 3, 'status' => 1, 'showHome' => 'No'],
            ['name' => 'Baby Food', 'slug' => Str::slug('Baby Food'), 'category_id' => 3, 'status' => 1, 'showHome' => 'No'],

            // Home & Living (ID:4)
            ['name' => 'Furniture', 'slug' => Str::slug('Furniture'), 'category_id' => 4, 'status' => 1, 'showHome' => 'No'],
            ['name' => 'Home Decor', 'slug' => Str::slug('Home Decor'), 'category_id' => 4, 'status' => 1, 'showHome' => 'No'],
            ['name' => 'Kitchen Tools', 'slug' => Str::slug('Kitchen Tools'), 'category_id' => 4, 'status' => 1, 'showHome' => 'No'],

            // Beauty (ID:5)
            ['name' => 'Makeup', 'slug' => Str::slug('Makeup'), 'category_id' => 5, 'status' => 1, 'showHome' => 'No'],
            ['name' => 'Skincare', 'slug' => Str::slug('Skincare'), 'category_id' => 5, 'status' => 1, 'showHome' => 'No'],
            ['name' => 'Haircare', 'slug' => Str::slug('Haircare'), 'category_id' => 5, 'status' => 1, 'showHome' => 'No'],

            // Sports (ID:6)
            ['name' => 'Gym Equipment', 'slug' => Str::slug('Gym Equipment'), 'category_id' => 6, 'status' => 1, 'showHome' => 'No'],
            ['name' => 'Outdoor Sports', 'slug' => Str::slug('Outdoor Sports'), 'category_id' => 6, 'status' => 1, 'showHome' => 'No'],

            // Baby Products (ID:7)
            ['name' => 'Baby Clothes', 'slug' => Str::slug('Baby Clothes'), 'category_id' => 7, 'status' => 1, 'showHome' => 'No'],
            ['name' => 'Diapers & Wipes', 'slug' => Str::slug('Diapers & Wipes'), 'category_id' => 7, 'status' => 1, 'showHome' => 'No'],

            // Computer (ID:8)
            ['name' => 'Keyboards & Mouse', 'slug' => Str::slug('Keyboards & Mouse'), 'category_id' => 8, 'status' => 1, 'showHome' => 'No'],
            ['name' => 'Monitors', 'slug' => Str::slug('Monitors'), 'category_id' => 8, 'status' => 1, 'showHome' => 'No'],
        ];

        foreach ($sub as $s) {
            DB::table('sub_categories')->insert(array_merge($s, [
                'created_at' => now(),
                'updated_at' => now()
            ]));
        }
    }
}
