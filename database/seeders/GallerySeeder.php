<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Gallery;
use Faker\Factory as Faker;
use Illuminate\Support\Arr;

class GallerySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        for ($i = 0; $i < 50; $i++) {
            $title = $faker->sentence();
            $description = $faker->paragraph();
            $imagePath = 'galleries/' . $faker->image('public/storage/galleries', rand(200, 800), rand(200, 600), null, false);

            Gallery::create([
                'title' => $title,
                'description' => $description,
                'image_path' => $imagePath,
            ]);
        }
    }
}
