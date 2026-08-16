<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Slider;
use App\Models\Banner;

class BannerSeeder extends Seeder
{
    public function run(): void
    {
        $sliders = [
            [
                'title' => 'Hot Summer Deal 50%-80% OFF',
                'subtitle' => 'Exclusive Summer Collection',
                'link' => '/product-category/fashion-women',
                'image' => '/uploads/image_directory/banner_image/3f82e680e88-2026-06-09.jpeg',
                'sort_order' => 1,
            ],
            [
                'title' => 'Ramadan Special Offer',
                'subtitle' => 'Premium Wallets, Sunglasses & Watches',
                'link' => '/product-category/man-fashion',
                'image' => '/uploads/image_directory/banner_image/2f432beec3-2026-02-22.jpeg',
                'sort_order' => 2,
            ],
            [
                'title' => 'Men\'s Formal & Casual Fits',
                'subtitle' => 'Premium Chinese Cotton Fabrics',
                'link' => '/product-category/man-fashion',
                'image' => '/uploads/image_directory/banner_image/ead3cd2e4d-2026-02-22.jpg',
                'sort_order' => 3,
            ],
            [
                'title' => 'Luxury Perfumes & Fragrances',
                'subtitle' => 'Long Lasting French Fragrance Sets',
                'link' => '/product-category/perfume',
                'image' => '/uploads/image_directory/banner_image/d63e0858df-2026-02-22.jpeg',
                'sort_order' => 4,
            ],
        ];

        foreach ($sliders as $slider) {
            Slider::updateOrCreate(['image' => $slider['image']], $slider);
        }

        $banners = [
            [
                'title' => 'Promo Card 1',
                'position' => 'middle_banner',
                'link' => '/product-category/man-fashion',
                'image' => '/uploads/image_directory/banner_image/2f432beec3-2026-02-22.jpeg',
            ],
            [
                'title' => 'Promo Card 2',
                'position' => 'middle_banner',
                'link' => '/product-category/fashion-women',
                'image' => '/uploads/image_directory/banner_image/ead3cd2e4d-2026-02-22.jpg',
            ],
        ];

        foreach ($banners as $banner) {
            Banner::updateOrCreate(['image' => $banner['image']], $banner);
        }
    }
}
