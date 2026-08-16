<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            [
                'id' => 1,
                'name' => 'Perfume',
                'slug' => 'perfume',
                'image' => '/uploads/category_image/cat_img958a5d386c-2026-02-23.jpg',
                'icon' => null,
                'priority' => 1,
                'is_featured' => 1,
            ],
            [
                'id' => 2,
                'name' => 'Jewellery',
                'slug' => 'jewellery',
                'image' => '/uploads/category_image/cat_img05797dce33-2026-02-23.webp',
                'icon' => null,
                'priority' => 2,
                'is_featured' => 1,
            ],
            [
                'id' => 3,
                'name' => 'Fashion',
                'slug' => 'fashion-women',
                'image' => '/uploads/category_image/cat_imge39cb94793-2025-12-03.jpg',
                'icon' => null,
                'priority' => 3,
                'is_featured' => 1,
            ],
            [
                'id' => 4,
                'name' => 'Chocolates',
                'slug' => 'choco-lates',
                'image' => '/uploads/category_image/cat_imge70f7ac4e9-2026-02-23.webp',
                'icon' => null,
                'priority' => 4,
                'is_featured' => 1,
            ],
            [
                'id' => 5,
                'name' => 'Sharee',
                'slug' => 'shar-ee',
                'image' => '/uploads/category_image/cat_img31b7e998c2-2026-02-23.jpg',
                'icon' => null,
                'priority' => 5,
                'is_featured' => 1,
            ],
            [
                'id' => 6,
                'name' => 'Man Fashion',
                'slug' => 'man-fashion',
                'image' => '/uploads/category_image/cat_imgfb98d10171-2026-02-23.jpg',
                'icon' => null,
                'priority' => 6,
                'is_featured' => 1,
            ],
            [
                'id' => 7,
                'name' => 'Formal Shirt',
                'slug' => 'formal-shirt',
                'image' => '/uploads/category_image/cat_imga7ab9a34a6-2026-05-04.webp',
                'icon' => null,
                'priority' => 7,
                'is_featured' => 1,
            ],
        ];

        foreach ($categories as $cat) {
            Category::updateOrCreate(['slug' => $cat['slug']], $cat);
        }
    }
}
