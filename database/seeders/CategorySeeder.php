<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            'Nature',
            'Travel',
            'Food',
            'Art',
            'Fashion',
            'Anime',
            'Technology',
            'Sports',
            'Music',
            'Health',
        ];

        foreach ($categories as $category) {
            Category::create(['name' => $category]);
        }
    }
}
