<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'category' => 'Laptop',
                'description' => 'Electronic Items',
            ],
            [
                'category' => 'Mobiles',
                'description' => 'Electronic Items',
            ],
            [
                'category' => 'Television',
                'description' => 'Electric Items',
            ],
            [
                'category' => 'Table Fan',
                'description' => 'Electronic Items',
            ],
            [
                'category' => 'Sofa',
                'description' => 'Furniture Items',
            ],
        ];

        foreach ($categories as $category) {
            Category::updateOrCreate(
                ['category' => $category['category']],
                ['description' => $category['description']]
            );
        }

        echo "Categories seeded successfully.\n";
    }
}
