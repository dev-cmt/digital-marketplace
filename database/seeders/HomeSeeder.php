<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HomeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['name' => 'Photos', 'slug' => 'photos', 'icon' => 'fa-regular fa-image', 'order' => 1],
            ['name' => 'Videos', 'slug' => 'videos', 'icon' => 'fa-solid fa-video', 'order' => 2],
            ['name' => 'Audio', 'slug' => 'audio', 'icon' => 'fa-solid fa-music', 'order' => 3],
            ['name' => 'Vectors', 'slug' => 'vectors', 'icon' => 'fa-solid fa-pen-nib', 'order' => 4],
            ['name' => '3D Assets', 'slug' => '3d-assets', 'icon' => 'fa-solid fa-cube', 'order' => 5],
            ['name' => 'Templates', 'slug' => 'templates', 'icon' => 'fa-solid fa-file-code', 'order' => 6],
        ];

        foreach ($categories as $cat) {
            $category = \App\Models\Category::create($cat);

            // Create some assets for each category
            for ($i = 1; $i <= 4; $i++) {
                \App\Models\Asset::create([
                    'category_id' => $category->id,
                    'title' => $cat['name'] . " Sample Asset $i",
                    'slug' => \Illuminate\Support\Str::slug($cat['name'] . " Sample Asset $i"),
                    'description' => "This is a premium " . strtolower($cat['name']) . " asset.",
                    'type' => strtolower(str_replace(' Assets', '', $cat['name'])),
                    'thumbnail' => 'https://images.unsplash.com/photo-1682685797208-c741d58c2eff?w=400&q=80',
                    'price' => $i % 2 == 0 ? 12.00 : null,
                    'is_free' => $i % 2 != 0,
                    'is_trending' => $i == 1,
                    'is_active' => true,
                    'likes_count' => rand(100, 5000),
                    'downloads_count' => rand(50, 2000),
                ]);
            }
        }
    }
}
