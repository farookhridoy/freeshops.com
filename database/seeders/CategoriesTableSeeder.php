<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $count = Category::count();

        if ($count == 0) {
            Category::create([
                'name' => 'Business & Industry',
                'slug' => 'business-industry',
                'status' => 1
            ]);
            Category::create([
                'name' => 'Cars & Vehicles',
                'slug' => 'cars-vehicles',
                'status' => 1
            ]);
            Category::create([
                'name' => 'Clothing, Shoes & Accessories',
                'slug' => 'clothing-shoes-accessories',
                'status' => 1
            ]);
            Category::create([
                'name' => 'Collectibles & Art',
                'slug' => 'collectibles-art',
                'status' => 1
            ]);
            Category::create([
                'name' => 'Education',
                'slug' => 'education',
                'status' => 1
            ]);
            Category::create([
                'name' => 'Electronics',
                'slug' => 'electronics',
                'status' => 1
            ]);
            Category::create([
                'name' => 'Food & Agriculture',
                'slug' => 'food-agriculture',
                'status' => 1
            ]);
            Category::create([
                'name' => 'General',
                'slug' => 'general',
                'status' => 1
            ]);
            Category::create([
                'name' => 'Health & Beauty',
                'slug' => 'health-beauty',
                'status' => 1
            ]);
            Category::create([
                'name' => 'Hobby, Sports & Kids',
                'slug' => 'hobby-sports-kids',
                'status' => 1
            ]);
            Category::create([
                'name' => 'Home Appliances',
                'slug' => 'home-appliances',
                'status' => 1
            ]);
            Category::create([
                'name' => 'Jobs',
                'slug' => 'jobs',
                'status' => 1
            ]);
            Category::create([
                'name' => 'Pets & Animals',
                'slug' => 'pets-animals',
                'status' => 1
            ]);
            Category::create([
                'name' => 'Property',
                'slug' => 'property',
                'status' => 1
            ]);
            Category::create([
                'name' => 'Services',
                'slug' => 'services',
                'status' => 1
            ]);
            Category::create([
                'name' => 'Toys, Games & Hobbies',
                'slug' => 'toys-games-hobbies',
                'status' => 1
            ]);
            Category::create([
                'name' => 'Wedding',
                'slug' => 'wedding',
                'status' => 1
            ]);
        }
    }
}
