<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Hardware',
                'description' => 'Problems related to computers, printers, monitors and other hardware devices.',
            ],
            [
                'name' => 'Software',
                'description' => 'Problems with installed software, applications and programs.',
            ],
            [
                'name' => 'Network',
                'description' => 'Problems related to internet connections, Wi-Fi, network access and connectivity.',
            ],
            [
                'name' => 'User Account',
                'description' => 'Problems with user accounts, login credentials, passwords and access permissions.',
            ],
            [
                'name' => 'Email',
                'description' => 'Problems related to email accounts, sending, receiving and email configuration.',
            ],
            [
                'name' => 'Database',
                'description' => 'Problems related to databases, data access, queries and database connections.',
            ],
            [
                'name' => 'Security',
                'description' => 'Security incidents, suspicious activity, access issues and other security-related problems.',
            ],
            [
                'name' => 'Application',
                'description' => 'Problems, errors and unexpected behavior in business applications.',
            ],
            [
                'name' => 'Performance',
                'description' => 'Problems related to slow systems, applications or poor system performance.',
            ],
            [
                'name' => 'Other',
                'description' => 'Technical requests and problems that do not belong to another category.',
            ],
        ];

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


// with API OpenAi
/*
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
    }*/

