<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Helpers\OpenAIHelper;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = OpenAIHelper::generateCategories(10);

        foreach ($categories as $category) {
            Category::create([
                'name' => $category['name'],
                'description' => $category['description'],
                'slug' => Str::slug($category['name']),
                'is_visible' => true,
            ]);
        }
    }
}
