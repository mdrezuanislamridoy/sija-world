<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Setting;
use App\Models\Page;

class SettingSeeder extends Seeder
{
    public function run(): void
    {
        Setting::updateOrCreate(
            ['id' => 1],
            [
                'site_name' => 'Miswan Fashion',
                'site_title' => 'Miswanfashion | Bangladesh’s Leading Fashion Brand',
                'logo' => '/uploads/image_directory/site/685ed7e04a0218.78429304.png',
                'favicon' => '/uploads/image_directory/site/685ed7e04a0218.78429304.png',
                'phone' => '+8801700000000',
                'email' => 'support@miswanfashion.com',
                'address' => 'House #12, Road #5, Dhanmondi, Dhaka, Bangladesh',
                'currency_symbol' => 'TK',
                'shipping_inside_city' => 60.00,
                'shipping_outside_city' => 120.00,
                'facebook_url' => 'https://www.facebook.com/p/Miswan-Fashion-61550113106815/',
                'announcement_text' => 'Upto 50% Discount on selected product. Ending Soon.',
            ]
        );

        $pages = [
            [
                'title' => 'About Us',
                'slug' => 'About-Us-2',
                'content' => '<h3>About Miswan Fashion</h3><p>Miswan Fashion is one of the leading lifestyle and fashion e-commerce platforms in Bangladesh, delivering premium quality apparel, fragrances, and accessories directly to your doorstep with guaranteed authenticity.</p>',
            ],
            [
                'title' => 'Terms & Conditions',
                'slug' => 'Terms-&-Conditions-4',
                'content' => '<h3>Terms and Conditions</h3><p>Welcome to Miswan Fashion. By accessing and placing an order on our platform, you agree to our standard terms of service, delivery policies, and cash-on-delivery guidelines.</p>',
            ],
            [
                'title' => 'Refund & Return Policy',
                'slug' => 'Refund-&-Return-Policy-5',
                'content' => '<h3>Return & Refund Policy</h3><p>We provide a 7-day hassle-free return policy if you receive a damaged, defective, or incorrect product. Please contact customer support with your invoice number to initiate a return.</p>',
            ],
            [
                'title' => 'Privacy Policy',
                'slug' => 'Privacy-Policy-3',
                'content' => '<h3>Privacy Policy</h3><p>We respect your privacy and protect your personal data. We will never sell or share your contact numbers or addresses with third parties.</p>',
            ],
        ];

        foreach ($pages as $p) {
            Page::updateOrCreate(['slug' => $p['slug']], $p);
        }
    }
}
