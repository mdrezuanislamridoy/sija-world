<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\ProductGallery;
use App\Models\ProductAttribute;
use App\Models\ProductAttributeValue;
use App\Models\ProductVariant;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            [
                'id' => 135,
                'category_id' => 6,
                'name' => 'Pant Cut Premium Pajama',
                'slug' => 'Pant-Cut-Premium-Pajama-135',
                'sku' => 'MSW-PAJ-135',
                'price' => 399.00,
                'previous_price' => 850.00,
                'discount_percent' => 54,
                'stock' => 17439,
                'short_description' => 'Premium quality cotton pant cut pajama with modern fitting and comfortable waist.',
                'description' => 'Premium Pant Cut Pajama made from 100% fine combed cotton. Features deep pockets, reinforced seams, and breathable fabric suitable for all seasons.',
                'thumbnail' => '/uploads/image_directory/product_image/1510192199-2026-05-14.webp',
                'is_featured' => 1,
                'is_bestseller' => 1,
                'is_hot' => 1,
            ],
            [
                'id' => 26,
                'category_id' => 6,
                'name' => 'Slim Wallet',
                'slug' => 'Slim-Wallet-26',
                'sku' => 'MSW-WLT-26',
                'price' => 450.00,
                'previous_price' => 950.00,
                'discount_percent' => 53,
                'stock' => 520,
                'short_description' => 'Genuine leather ultra-slim bifold wallet with RFID blocking and card slots.',
                'description' => 'Sleek and compact genuine leather wallet. Designed to easily slip into front and back pockets while accommodating all your cards and cash effortlessly.',
                'thumbnail' => '/uploads/image_directory/product_image/94c8ab818d-2026-03-13.webp',
                'is_featured' => 1,
                'is_bestseller' => 1,
                'is_hot' => 0,
            ],
            [
                'id' => 72,
                'category_id' => 6,
                'name' => 'T-Shirt (Rubber Printed)',
                'slug' => 'T-Shirt-Rubber-Printed-72',
                'sku' => 'MSW-TSH-72',
                'price' => 350.00,
                'previous_price' => 750.00,
                'discount_percent' => 53,
                'stock' => 340,
                'short_description' => '100% organic cotton drop-shoulder rubber printed t-shirt.',
                'description' => 'High quality 180+ GSM combed cotton with premium rubber print that will not crack or fade over washes.',
                'thumbnail' => '/uploads/image_directory/product_image/ba344ec300-2026-02-23.jpg',
                'is_featured' => 1,
                'is_bestseller' => 1,
                'is_hot' => 1,
            ],
            [
                'id' => 87,
                'category_id' => 6,
                'name' => 'Man Watch-Olives (Premium)',
                'slug' => 'Man-Watch-Olives-Premium-87',
                'sku' => 'MSW-WTC-87',
                'price' => 1250.00,
                'previous_price' => 2500.00,
                'discount_percent' => 50,
                'stock' => 120,
                'short_description' => 'Luxury analog quartz wrist watch for men with stainless steel strap.',
                'description' => 'Elegant Olives branded men watch crafted with high precision quartz movement, mineral glass lens, and waterproof casing.',
                'thumbnail' => '/uploads/image_directory/product_image/8794df99b8-2026-05-02.webp',
                'is_featured' => 1,
                'is_bestseller' => 1,
                'is_hot' => 0,
            ],
            [
                'id' => 84,
                'category_id' => 5,
                'name' => 'Black Elite Eligance Sharee',
                'slug' => 'Black-Elite-Eligance-Sharee-84',
                'sku' => 'MSW-SHR-84',
                'price' => 1850.00,
                'previous_price' => 3500.00,
                'discount_percent' => 47,
                'stock' => 85,
                'short_description' => 'Exclusive designer silk sharee with zari border work.',
                'description' => 'Gorgeous party wear black silk sharee with detailed embroidery on aanchal and borders. Comes with matching unstitched blouse piece.',
                'thumbnail' => '/uploads/image_directory/product_image/0821823ca6-2025-12-24.png',
                'is_featured' => 1,
                'is_bestseller' => 1,
                'is_hot' => 1,
            ],
            [
                'id' => 82,
                'category_id' => 2,
                'name' => 'ইন্ডিয়ান বেইলি পায়েল',
                'slug' => 'Indian-Beli-Rupar-Payel-82',
                'sku' => 'MSW-JWL-82',
                'price' => 499.00,
                'previous_price' => 999.00,
                'discount_percent' => 50,
                'stock' => 210,
                'short_description' => 'Traditional silver plated bell anklet with intricate craftsmanship.',
                'description' => 'Handcrafted silver-tone payel with chime bells that produce a melodious sound. Non-tarnish protective coating.',
                'thumbnail' => '/uploads/image_directory/product_image/2b83726ac6-2026-02-16.jpg',
                'is_featured' => 1,
                'is_bestseller' => 1,
                'is_hot' => 0,
            ],
            [
                'id' => 141,
                'category_id' => 6,
                'name' => 'Gentle Belt-Leather',
                'slug' => 'Gentle-Belt-Leather-141',
                'sku' => 'MSW-BLT-141',
                'price' => 550.00,
                'previous_price' => 1100.00,
                'discount_percent' => 50,
                'stock' => 180,
                'short_description' => 'Premium top-grain cowhide leather belt with metallic automatic buckle.',
                'description' => 'Durable and formal leather belt crafted from selected full grain hide. Adjustable automatic buckle system for perfect fit.',
                'thumbnail' => '/uploads/image_directory/product_image/ad527e7051-2026-05-02.jpeg',
                'is_featured' => 1,
                'is_bestseller' => 1,
                'is_hot' => 0,
            ],
            [
                'id' => 114,
                'category_id' => 1,
                'name' => 'After You 30 ML 5 Flavour Set',
                'slug' => 'After-You-30-ML-5-Flavour-Set-114',
                'sku' => 'MSW-PRF-114',
                'price' => 999.00,
                'previous_price' => 1999.00,
                'discount_percent' => 50,
                'stock' => 95,
                'short_description' => 'Luxury 5-in-1 French Eau De Parfum collection (30ml x 5 bottles).',
                'description' => 'Long-lasting premium perfume gift set containing 5 signature fragrances ranging from fresh citrus to woody oriental notes.',
                'thumbnail' => '/uploads/image_directory/product_image/7f8ef60f2e-2026-08-07.jpeg',
                'is_featured' => 1,
                'is_bestseller' => 1,
                'is_hot' => 1,
            ],
        ];

        foreach ($products as $prodData) {
            $product = Product::updateOrCreate(['id' => $prodData['id']], $prodData);

            // Add gallery images if available
            ProductGallery::updateOrCreate(
                ['product_id' => $product->id, 'image' => $product->thumbnail],
                ['product_id' => $product->id, 'image' => $product->thumbnail]
            );

            // Add sizes for apparel products
            if (in_array($product->category_id, [3, 5, 6, 7])) {
                $attr = ProductAttribute::updateOrCreate(
                    ['product_id' => $product->id, 'name' => 'Size'],
                    ['product_id' => $product->id, 'name' => 'Size']
                );
                
                $sizes = ['M (38)', 'L (40)', 'XL (42)',];
                foreach ($sizes as $size) {
                    ProductAttributeValue::updateOrCreate(
                        ['attribute_id' => $attr->id, 'value' => $size],
                        ['attribute_id' => $attr->id, 'value' => $size]
                    );

                    ProductVariant::updateOrCreate(
                        ['product_id' => $product->id, 'variant_name' => $size],
                        [
                            'product_id' => $product->id,
                            'variant_name' => $size,
                            'price' => $product->price,
                            'stock' => 50,
                            'attr_info' => ['Size' => $size]
                        ]
                    );
                }
            }
        }
    }
}
