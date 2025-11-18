<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
public function run()
{
    // // First seed categories
    // \App\Models\Category::factory(30)->create();

    // // Then seed products (category must exist)
    // \App\Models\Product::factory(30)->create();

    // Other seeders
    $this->call([
        CountrySeeder::class,
            //         CategorySeeder::class,
            // SubCategorySeeder::class,
            BrandSeeder::class,
            // ProductSeeder::class,
            ECommerceSeeder::class,
            UserSeeder::class

    ]);
}

}
