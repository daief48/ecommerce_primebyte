<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class BrandSeeder extends Seeder
{
    public function run()
    {
        $brands = [
            ['name' => 'Nike', 'slug' => Str::slug('Nike'), 'status' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Adidas', 'slug' => Str::slug('Adidas'), 'status' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Samsung', 'slug' => Str::slug('Samsung'), 'status' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Apple', 'slug' => Str::slug('Apple'), 'status' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Walton', 'slug' => Str::slug('Walton'), 'status' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Fresh', 'slug' => Str::slug('Fresh'), 'status' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Radhuni', 'slug' => Str::slug('Radhuni'), 'status' => 1, 'created_at' => now(), 'updated_at' => now()],
        ];

        DB::table('brands')->insert($brands);
    }
}
