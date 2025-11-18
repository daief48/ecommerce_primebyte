<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ECommerceSeeder extends Seeder
{
    public function run()
    {
        // 1) Categories
        $categories = [
            ['name' => 'Clothing', 'slug' => Str::slug('Clothing'), 'image' => 'categories/clothing.jpg', 'status' => 1, 'showHome' => 'Yes', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Electronics', 'slug' => Str::slug('Electronics'), 'image' => 'categories/electronics.jpg', 'status' => 1, 'showHome' => 'Yes', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Grocery & Daily Needs', 'slug' => Str::slug('Grocery & Daily Needs'), 'image' => 'categories/grocery.jpg', 'status' => 1, 'showHome' => 'Yes', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Home & Living', 'slug' => Str::slug('Home & Living'), 'image' => 'categories/home.jpg', 'status' => 1, 'showHome' => 'No', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Beauty & Personal Care', 'slug' => Str::slug('Beauty & Personal Care'), 'image' => 'categories/beauty.jpg', 'status' => 1, 'showHome' => 'No', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Sports & Outdoor', 'slug' => Str::slug('Sports & Outdoor'), 'image' => 'categories/sports.jpg', 'status' => 1, 'showHome' => 'No', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Baby Products', 'slug' => Str::slug('Baby Products'), 'image' => 'categories/baby.jpg', 'status' => 1, 'showHome' => 'No', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Computer Accessories', 'slug' => Str::slug('Computer Accessories'), 'image' => 'categories/computer.jpg', 'status' => 1, 'showHome' => 'No', 'created_at' => now(), 'updated_at' => now()],
        ];

        DB::table('categories')->insert($categories);

        // 2) Subcategories
        $subCategories = [
            // Clothing
            ['name' => 'Men Clothing', 'slug' => Str::slug('Men Clothing'), 'category_id' => 1, 'status' => 1, 'showHome' => 'Yes'],
            ['name' => 'Women Clothing', 'slug' => Str::slug('Women Clothing'), 'category_id' => 1, 'status' => 1, 'showHome' => 'Yes'],
            ['name' => 'Kid Fashion', 'slug' => Str::slug('Kid Fashion'), 'category_id' => 1, 'status' => 1, 'showHome' => 'No'],
            ['name' => 'Winter Wear', 'slug' => Str::slug('Winter Wear'), 'category_id' => 1, 'status' => 1, 'showHome' => 'No'],

            // Electronics
            ['name' => 'Smartphones', 'slug' => Str::slug('Smartphones'), 'category_id' => 2, 'status' => 1, 'showHome' => 'Yes'],
            ['name' => 'Laptops', 'slug' => Str::slug('Laptops'), 'category_id' => 2, 'status' => 1, 'showHome' => 'Yes'],
            ['name' => 'Smart Gadgets', 'slug' => Str::slug('Smart Gadgets'), 'category_id' => 2, 'status' => 1, 'showHome' => 'No'],
            ['name' => 'Televisions', 'slug' => Str::slug('Televisions'), 'category_id' => 2, 'status' => 1, 'showHome' => 'No'],
            ['name' => 'Headphones & Audio', 'slug' => Str::slug('Headphones & Audio'), 'category_id' => 2, 'status' => 1, 'showHome' => 'No'],

            // Grocery
            ['name' => 'Rice & Oil', 'slug' => Str::slug('Rice & Oil'), 'category_id' => 3, 'status' => 1, 'showHome' => 'Yes'],
            ['name' => 'Snacks & Beverages', 'slug' => Str::slug('Snacks & Beverages'), 'category_id' => 3, 'status' => 1, 'showHome' => 'Yes'],
            ['name' => 'Household Items', 'slug' => Str::slug('Household Items'), 'category_id' => 3, 'status' => 1, 'showHome' => 'No'],
            ['name' => 'Baby Food', 'slug' => Str::slug('Baby Food'), 'category_id' => 3, 'status' => 1, 'showHome' => 'No'],

            // Home & Living
            ['name' => 'Furniture', 'slug' => Str::slug('Furniture'), 'category_id' => 4, 'status' => 1, 'showHome' => 'No'],
            ['name' => 'Home Decor', 'slug' => Str::slug('Home Decor'), 'category_id' => 4, 'status' => 1, 'showHome' => 'No'],
            ['name' => 'Kitchen Tools', 'slug' => Str::slug('Kitchen Tools'), 'category_id' => 4, 'status' => 1, 'showHome' => 'No'],

            // Beauty
            ['name' => 'Makeup', 'slug' => Str::slug('Makeup'), 'category_id' => 5, 'status' => 1, 'showHome' => 'No'],
            ['name' => 'Skincare', 'slug' => Str::slug('Skincare'), 'category_id' => 5, 'status' => 1, 'showHome' => 'No'],
            ['name' => 'Haircare', 'slug' => Str::slug('Haircare'), 'category_id' => 5, 'status' => 1, 'showHome' => 'No'],

            // Sports
            ['name' => 'Gym Equipment', 'slug' => Str::slug('Gym Equipment'), 'category_id' => 6, 'status' => 1, 'showHome' => 'No'],
            ['name' => 'Outdoor Sports', 'slug' => Str::slug('Outdoor Sports'), 'category_id' => 6, 'status' => 1, 'showHome' => 'No'],

            // Baby Products
            ['name' => 'Baby Clothes', 'slug' => Str::slug('Baby Clothes'), 'category_id' => 7, 'status' => 1, 'showHome' => 'No'],
            ['name' => 'Diapers & Wipes', 'slug' => Str::slug('Diapers & Wipes'), 'category_id' => 7, 'status' => 1, 'showHome' => 'No'],

            // Computer Accessories
            ['name' => 'Keyboards & Mouse', 'slug' => Str::slug('Keyboards & Mouse'), 'category_id' => 8, 'status' => 1, 'showHome' => 'No'],
            ['name' => 'Monitors', 'slug' => Str::slug('Monitors'), 'category_id' => 8, 'status' => 1, 'showHome' => 'No'],
        ];

        foreach ($subCategories as $s) {
            DB::table('sub_categories')->insert(array_merge($s, ['created_at' => now(), 'updated_at' => now()]));
        }

        // 3) Products
        $products = [
            // Clothing
            [
                'title' => 'Men Cotton T-Shirt', 'slug' => Str::slug('Men Cotton T-Shirt'), 'description' => 'Premium quality 100% cotton T-Shirt for men.',
                'short_description' => 'Soft and comfortable.', 'shipping_returns' => '3–5 days delivery.', 'related_products' => null,
                'price' => 450, 'compare_price' => 550, 'category_id' => 1, 'sub_category_id' => 1, 'brand_id' => 1,
                'is_featured' => 'Yes', 'sku' => 'TSHIRT-001', 'barcode' => '123456789012', 'track_qty' => 'Yes', 'qty' => 100,
                'status' => 1, 'created_at' => now(), 'updated_at' => now(),
            ],
            [
                'title' => 'Premium Men Sneakers', 'slug' => Str::slug('Premium Men Sneakers'), 'description' => 'Lightweight and stylish sneakers.',
                'short_description' => 'Casual wear shoes.', 'shipping_returns' => 'Free delivery over 1000 TK.', 'related_products' => null,
                'price' => 2200, 'compare_price' => 2800, 'category_id' => 1, 'sub_category_id' => 1, 'brand_id' => 2,
                'is_featured' => 'No', 'sku' => 'SHOE-244', 'barcode' => '321654789012', 'track_qty' => 'Yes', 'qty' => 60,
                'status' => 1, 'created_at' => now(), 'updated_at' => now(),
            ],

            // Electronics
            [
                'title' => 'Samsung Galaxy A55', 'slug' => Str::slug('Samsung Galaxy A55'), 'description' => 'AMOLED display, long battery.',
                'short_description' => 'Official warranty.', 'shipping_returns' => 'Fast delivery.', 'related_products' => null,
                'price' => 42000, 'compare_price' => 45000, 'category_id' => 2, 'sub_category_id' => 5, 'brand_id' => 3,
                'is_featured' => 'Yes', 'sku' => 'PHONE-101', 'barcode' => '987654321012', 'track_qty' => 'Yes', 'qty' => 50,
                'status' => 1, 'created_at' => now(), 'updated_at' => now(),
            ],
            [
                'title' => 'Xiaomi 43-inch Smart LED TV', 'slug' => Str::slug('Xiaomi 43-inch Smart LED TV'), 'description' => 'Full HD, Android TV.',
                'short_description' => 'Crystal clear picture.', 'shipping_returns' => 'Comes with 2 year warranty.', 'related_products' => null,
                'price' => 31000, 'compare_price' => 35000, 'category_id' => 2, 'sub_category_id' => 8, 'brand_id' => 3,
                'is_featured' => 'No', 'sku' => 'TV-543', 'barcode' => '546987321012', 'track_qty' => 'Yes', 'qty' => 30,
                'status' => 1, 'created_at' => now(), 'updated_at' => now(),
            ],
            [
                'title' => 'Apple AirPods 3rd Gen', 'slug' => Str::slug('Apple AirPods 3rd Gen'), 'description' => 'Original Apple AirPods.',
                'short_description' => 'Spatial audio, premium sound.', 'shipping_returns' => '100% authentic.', 'related_products' => null,
                'price' => 23500, 'compare_price' => 25000, 'category_id' => 2, 'sub_category_id' => 9, 'brand_id' => 4,
                'is_featured' => 'Yes', 'sku' => 'AIRPOD-23', 'barcode' => '998877665544', 'track_qty' => 'Yes', 'qty' => 40,
                'status' => 1, 'created_at' => now(), 'updated_at' => now(),
            ],

            // Computer Accessories
            [
                'title' => 'Logitech Gaming Mouse G102', 'slug' => Str::slug('Logitech Gaming Mouse G102'), 'description' => 'RGB gaming mouse 8000 DPI.',
                'short_description' => 'Best for gamers.', 'shipping_returns' => 'Delivery 48 hours.', 'related_products' => null,
                'price' => 1850, 'compare_price' => 2200, 'category_id' => 8, 'sub_category_id' => 19, 'brand_id' => 3,
                'is_featured' => 'No', 'sku' => 'MOUSE-112', 'barcode' => '885544778899', 'track_qty' => 'Yes', 'qty' => 120,
                'status' => 1, 'created_at' => now(), 'updated_at' => now(),
            ],

            // Grocery
            [
                'title' => 'Radhuni Mustard Oil 1L', 'slug' => Str::slug('Radhuni Mustard Oil 1L'), 'description' => 'Pure mustard oil for cooking.',
                'short_description' => '100% natural.', 'shipping_returns' => '24 hours delivery.', 'related_products' => null,
                'price' => 185, 'compare_price' => 200, 'category_id' => 3, 'sub_category_id' => 11, 'brand_id' => 7,
                'is_featured' => 'No', 'sku' => 'OIL-501', 'barcode' => '456789123654', 'track_qty' => 'Yes', 'qty' => 200,
                'status' => 1, 'created_at' => now(), 'updated_at' => now(),
            ],
            [
                'title' => 'Miniket Rice 5KG', 'slug' => Str::slug('Miniket Rice 5KG'), 'description' => 'Premium Miniket rice.',
                'short_description' => 'Fresh and clean.', 'shipping_returns' => 'Next day delivery.', 'related_products' => null,
                'price' => 420, 'compare_price' => 460, 'category_id' => 3, 'sub_category_id' => 11, 'brand_id' => 6,
                'is_featured' => 'No', 'sku' => 'RICE-005', 'barcode' => '445566778899', 'track_qty' => 'Yes', 'qty' => 300,
                'status' => 1, 'created_at' => now(), 'updated_at' => now(),
            ],

            // Baby Products
            [
                'title' => 'Pampers Baby Diaper Large', 'slug' => Str::slug('Pampers Baby Diaper Large'), 'description' => 'Comfortable and safe diapers.',
                'short_description' => 'Super soft.', 'shipping_returns' => 'Same-day delivery.', 'related_products' => null,
                'price' => 950, 'compare_price' => 1100, 'category_id' => 7, 'sub_category_id' => 17, 'brand_id' => 7,
                'is_featured' => 'No', 'sku' => 'DIAPER-L', 'barcode' => '556677889900', 'track_qty' => 'Yes', 'qty' => 180,
                'status' => 1, 'created_at' => now(), 'updated_at' => now(),
            ],

            // Beauty
            [
                'title' => 'Huda Beauty Makeup Set', 'slug' => Str::slug('Huda Beauty Makeup Set'), 'description' => '60+ item premium makeup kit.',
                'short_description' => 'Professional level.', 'shipping_returns' => 'Delivery within Dhaka.', 'related_products' => null,
                'price' => 3200, 'compare_price' => 3600, 'category_id' => 5, 'sub_category_id' => 14, 'brand_id' => 2,
                'is_featured' => 'No', 'sku' => 'MAKEUP-77', 'barcode' => '123443211234', 'track_qty' => 'Yes', 'qty' => 70,
                'status' => 1, 'created_at' => now(), 'updated_at' => now(),
            ],
        ];

        DB::table('products')->insert($products);
    }
}
