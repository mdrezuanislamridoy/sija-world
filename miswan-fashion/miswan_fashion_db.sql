-- Table: migrations
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (`id` integer primary key autoincrement not null, `migration` varchar not null, `batch` integer not null);

-- Data for: migrations
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES ('1', '2026_01_01_000001_create_users_table', '1');
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES ('2', '2026_01_01_000002_create_admins_table', '1');
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES ('3', '2026_01_01_000003_create_categories_table', '1');
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES ('4', '2026_01_01_000004_create_sub_categories_table', '1');
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES ('5', '2026_01_01_000005_create_products_table', '1');
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES ('6', '2026_01_01_000006_create_product_galleries_table', '1');
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES ('7', '2026_01_01_000007_create_product_attributes_and_variants_tables', '1');
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES ('8', '2026_01_01_000008_create_orders_and_order_items_tables', '1');
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES ('9', '2026_01_01_000009_create_banners_and_sliders_tables', '1');
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES ('10', '2026_01_01_000010_create_coupons_districts_settings_tables', '1');
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES ('11', '2026_08_16_160820_add_colors_to_products_table', '2');
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES ('12', '2026_08_16_175800_add_product_id_to_sliders_and_banners_tables', '3');
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES ('13', '2026_08_16_181000_add_permissions_to_admins_table', '3');

-- Table: users
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (`id` integer primary key autoincrement not null, `name` varchar not null, `phone` varchar, `email` varchar, `email_verified_at` datetime, `password` varchar not null, `address` varchar, `district` varchar, `upazila` varchar, `avatar` varchar, `status` tinyint(1) not null default '1', `remember_token` varchar, `created_at` datetime, `updated_at` datetime);

-- Data for: users
INSERT INTO `users` (`id`, `name`, `phone`, `email`, `email_verified_at`, `password`, `address`, `district`, `upazila`, `avatar`, `status`, `remember_token`, `created_at`, `updated_at`) VALUES ('1', 'Demo Customer', '01711112222', 'customer@example.com', NULL, '$2y$12$9vkTn3WWRkVA0JoTteDrCedFsQoMvPQPq6iZHUz0jsfIZvdRaK33q', 'House 10, Road 4, Dhanmondi, Dhaka', 'Dhaka', 'Dhaka Sadar', NULL, '1', NULL, '2026-08-16 14:00:34', '2026-08-16 14:00:34');
INSERT INTO `users` (`id`, `name`, `phone`, `email`, `email_verified_at`, `password`, `address`, `district`, `upazila`, `avatar`, `status`, `remember_token`, `created_at`, `updated_at`) VALUES ('2', 'Regina Akhter', '01712345678', 'reginaakhter055@gmail.com', NULL, '$2y$12$c5tv3yqtVyukQYlwmp9OpuAvipxmQW1.9ayQTC/7XoBWrBjZZK2em', NULL, NULL, NULL, NULL, '1', NULL, '2026-08-16 14:02:13', '2026-08-16 14:02:13');

-- Table: password_reset_tokens
DROP TABLE IF EXISTS `password_reset_tokens`;
CREATE TABLE `password_reset_tokens` (`email` varchar not null, `token` varchar not null, `created_at` datetime, primary key (`email`));

-- Table: sessions
DROP TABLE IF EXISTS `sessions`;
CREATE TABLE `sessions` (`id` varchar not null, `user_id` integer, `ip_address` varchar, `user_agent` text, `payload` text not null, `last_activity` integer not null, primary key (`id`));

-- Table: admins
DROP TABLE IF EXISTS `admins`;
CREATE TABLE `admins` (`id` integer primary key autoincrement not null, `name` varchar not null, `email` varchar not null, `phone` varchar, `password` varchar not null, `role` varchar not null default 'super_admin', `avatar` varchar, `status` tinyint(1) not null default '1', `remember_token` varchar, `created_at` datetime, `updated_at` datetime, `permissions` text);

-- Data for: admins
INSERT INTO `admins` (`id`, `name`, `email`, `phone`, `password`, `role`, `avatar`, `status`, `remember_token`, `created_at`, `updated_at`, `permissions`) VALUES ('1', 'Miswan Super Admin', 'admin@miswanfashion.com', '+8801700000001', '$2y$12$xM6An2Hh2HNfq9Cr47yR/eG9H9lIv7Y/1YbfI91epyYvEZY8Cq8fi', 'super_admin', NULL, '1', NULL, '2026-08-16 14:00:34', '2026-08-16 14:00:34', NULL);
INSERT INTO `admins` (`id`, `name`, `email`, `phone`, `password`, `role`, `avatar`, `status`, `remember_token`, `created_at`, `updated_at`, `permissions`) VALUES ('2', 'Razina Akter', 'razinaakter051@gmail.com', '0147688888886', '$2y$12$4fmSch86veOpyfIdM7SDzufeRgiG/rHrItU8aw.GqhG5Uh06kVjwS', 'sub_admin', NULL, '1', NULL, '2026-08-16 18:30:14', '2026-08-16 18:30:14', '["manage_products","manage_orders"]');

-- Table: categories
DROP TABLE IF EXISTS `categories`;
CREATE TABLE `categories` (`id` integer primary key autoincrement not null, `name` varchar not null, `slug` varchar not null, `image` varchar, `banner` varchar, `icon` varchar, `description` text, `priority` integer not null default '0', `is_featured` tinyint(1) not null default '1', `status` tinyint(1) not null default '1', `created_at` datetime, `updated_at` datetime);

-- Data for: categories
INSERT INTO `categories` (`id`, `name`, `slug`, `image`, `banner`, `icon`, `description`, `priority`, `is_featured`, `status`, `created_at`, `updated_at`) VALUES ('1', 'Perfume', 'perfume', '/uploads/category_image/cat_img958a5d386c-2026-02-23.jpg', NULL, NULL, NULL, '1', '1', '1', '2026-08-16 14:00:34', '2026-08-16 14:00:34');
INSERT INTO `categories` (`id`, `name`, `slug`, `image`, `banner`, `icon`, `description`, `priority`, `is_featured`, `status`, `created_at`, `updated_at`) VALUES ('2', 'Jewellery', 'jewellery', '/uploads/category_image/cat_img05797dce33-2026-02-23.webp', NULL, NULL, NULL, '2', '1', '1', '2026-08-16 14:00:34', '2026-08-16 14:00:34');
INSERT INTO `categories` (`id`, `name`, `slug`, `image`, `banner`, `icon`, `description`, `priority`, `is_featured`, `status`, `created_at`, `updated_at`) VALUES ('3', 'Fashion', 'fashion-women', '/uploads/category_image/cat_imge39cb94793-2025-12-03.jpg', NULL, NULL, NULL, '3', '1', '1', '2026-08-16 14:00:34', '2026-08-16 14:00:34');
INSERT INTO `categories` (`id`, `name`, `slug`, `image`, `banner`, `icon`, `description`, `priority`, `is_featured`, `status`, `created_at`, `updated_at`) VALUES ('4', 'Chocolates', 'choco-lates', '/uploads/category_image/cat_imge70f7ac4e9-2026-02-23.webp', NULL, NULL, NULL, '4', '1', '1', '2026-08-16 14:00:34', '2026-08-16 14:00:34');
INSERT INTO `categories` (`id`, `name`, `slug`, `image`, `banner`, `icon`, `description`, `priority`, `is_featured`, `status`, `created_at`, `updated_at`) VALUES ('5', 'Sharee', 'shar-ee', '/uploads/category_image/cat_img31b7e998c2-2026-02-23.jpg', NULL, NULL, NULL, '5', '1', '1', '2026-08-16 14:00:34', '2026-08-16 14:00:34');
INSERT INTO `categories` (`id`, `name`, `slug`, `image`, `banner`, `icon`, `description`, `priority`, `is_featured`, `status`, `created_at`, `updated_at`) VALUES ('6', 'Man Fashion', 'man-fashion', '/uploads/category_image/cat_imgfb98d10171-2026-02-23.jpg', NULL, NULL, NULL, '6', '1', '1', '2026-08-16 14:00:34', '2026-08-16 14:00:34');
INSERT INTO `categories` (`id`, `name`, `slug`, `image`, `banner`, `icon`, `description`, `priority`, `is_featured`, `status`, `created_at`, `updated_at`) VALUES ('7', 'Formal Shirt', 'formal-shirt', '/uploads/category_image/cat_imga7ab9a34a6-2026-05-04.webp', NULL, NULL, NULL, '7', '1', '1', '2026-08-16 14:00:34', '2026-08-16 14:00:34');

-- Table: sub_categories
DROP TABLE IF EXISTS `sub_categories`;
CREATE TABLE `sub_categories` (`id` integer primary key autoincrement not null, `category_id` integer not null, `name` varchar not null, `slug` varchar not null, `image` varchar, `priority` integer not null default '0', `status` tinyint(1) not null default '1', `created_at` datetime, `updated_at` datetime, foreign key(`category_id`) references `categories`(`id`) on delete cascade);

-- Table: products
DROP TABLE IF EXISTS `products`;
CREATE TABLE `products` (`id` integer primary key autoincrement not null, `category_id` integer, `sub_category_id` integer, `name` varchar not null, `slug` varchar not null, `sku` varchar, `price` numeric not null, `previous_price` numeric, `discount_percent` integer not null default '0', `stock` integer not null default '100', `short_description` text, `description` text, `thumbnail` varchar, `video_link` varchar, `is_featured` tinyint(1) not null default '0', `is_bestseller` tinyint(1) not null default '0', `is_hot` tinyint(1) not null default '0', `is_new` tinyint(1) not null default '1', `status` tinyint(1) not null default '1', `views` integer not null default '0', `created_at` datetime, `updated_at` datetime, `colors` varchar, foreign key(`category_id`) references `categories`(`id`) on delete set null, foreign key(`sub_category_id`) references `sub_categories`(`id`) on delete set null);

-- Data for: products
INSERT INTO `products` (`id`, `category_id`, `sub_category_id`, `name`, `slug`, `sku`, `price`, `previous_price`, `discount_percent`, `stock`, `short_description`, `description`, `thumbnail`, `video_link`, `is_featured`, `is_bestseller`, `is_hot`, `is_new`, `status`, `views`, `created_at`, `updated_at`, `colors`) VALUES ('26', '6', NULL, 'Slim Wallet', 'Slim-Wallet-26', 'MSW-WLT-26', '450', '950', '53', '520', 'Genuine leather ultra-slim bifold wallet with RFID blocking and card slots.', 'Sleek and compact genuine leather wallet. Designed to easily slip into front and back pockets while accommodating all your cards and cash effortlessly.', '/uploads/image_directory/product_image/94c8ab818d-2026-03-13.webp', NULL, '1', '1', '0', '1', '1', '0', '2026-08-16 14:00:34', '2026-08-16 14:00:34', NULL);
INSERT INTO `products` (`id`, `category_id`, `sub_category_id`, `name`, `slug`, `sku`, `price`, `previous_price`, `discount_percent`, `stock`, `short_description`, `description`, `thumbnail`, `video_link`, `is_featured`, `is_bestseller`, `is_hot`, `is_new`, `status`, `views`, `created_at`, `updated_at`, `colors`) VALUES ('72', '6', NULL, 'comfort pant(Rubber)', 'T-Shirt-Rubber-Printed-72', 'MSW-TSH-72', '499', '800', '38', '898', '100% organic cotton drop-shoulder rubber pant.', 'High quality 180+ GSM combed cotton with premium rubber print that will not crack or fade over washes.', 'uploads/products/1786877906_Gemini_Generated_Image_cblvlvcblvlvcblv.jpg', NULL, '1', '1', '1', '1', '1', '15', '2026-08-16 14:00:35', '2026-08-16 17:26:50', 'White');
INSERT INTO `products` (`id`, `category_id`, `sub_category_id`, `name`, `slug`, `sku`, `price`, `previous_price`, `discount_percent`, `stock`, `short_description`, `description`, `thumbnail`, `video_link`, `is_featured`, `is_bestseller`, `is_hot`, `is_new`, `status`, `views`, `created_at`, `updated_at`, `colors`) VALUES ('82', '2', NULL, 'ইন্ডিয়ান বেইলি পায়েল', 'Indian-Beli-Rupar-Payel-82', 'MSW-JWL-82', '499', '999', '50', '210', 'Traditional silver plated bell anklet with intricate craftsmanship.', 'Handcrafted silver-tone payel with chime bells that produce a melodious sound. Non-tarnish protective coating.', '/uploads/image_directory/product_image/2b83726ac6-2026-02-16.jpg', NULL, '1', '1', '0', '1', '1', '0', '2026-08-16 14:00:35', '2026-08-16 14:00:35', NULL);
INSERT INTO `products` (`id`, `category_id`, `sub_category_id`, `name`, `slug`, `sku`, `price`, `previous_price`, `discount_percent`, `stock`, `short_description`, `description`, `thumbnail`, `video_link`, `is_featured`, `is_bestseller`, `is_hot`, `is_new`, `status`, `views`, `created_at`, `updated_at`, `colors`) VALUES ('84', '5', NULL, 'Black Elite Eligance Sharee', 'Black-Elite-Eligance-Sharee-84', 'MSW-SHR-84', '1850', '3500', '47', '85', 'Exclusive designer silk sharee with zari border work.', 'Gorgeous party wear black silk sharee with detailed embroidery on aanchal and borders. Comes with matching unstitched blouse piece.', '/uploads/image_directory/product_image/0821823ca6-2025-12-24.png', NULL, '1', '1', '1', '1', '1', '0', '2026-08-16 14:00:35', '2026-08-16 14:00:35', NULL);
INSERT INTO `products` (`id`, `category_id`, `sub_category_id`, `name`, `slug`, `sku`, `price`, `previous_price`, `discount_percent`, `stock`, `short_description`, `description`, `thumbnail`, `video_link`, `is_featured`, `is_bestseller`, `is_hot`, `is_new`, `status`, `views`, `created_at`, `updated_at`, `colors`) VALUES ('87', '6', NULL, 'Man Watch-Olives (Premium)', 'Man-Watch-Olives-Premium-87', 'MSW-WTC-87', '1250', '2500', '50', '120', 'Luxury analog quartz wrist watch for men with stainless steel strap.', 'Elegant Olives branded men watch crafted with high precision quartz movement, mineral glass lens, and waterproof casing.', '/uploads/image_directory/product_image/8794df99b8-2026-05-02.webp', NULL, '1', '1', '0', '1', '1', '0', '2026-08-16 14:00:35', '2026-08-16 14:00:35', NULL);
INSERT INTO `products` (`id`, `category_id`, `sub_category_id`, `name`, `slug`, `sku`, `price`, `previous_price`, `discount_percent`, `stock`, `short_description`, `description`, `thumbnail`, `video_link`, `is_featured`, `is_bestseller`, `is_hot`, `is_new`, `status`, `views`, `created_at`, `updated_at`, `colors`) VALUES ('114', '1', NULL, 'After You 30 ML 5 Flavour Set', 'After-You-30-ML-5-Flavour-Set-114', 'MSW-PRF-114', '999', '1999', '50', '95', 'Luxury 5-in-1 French Eau De Parfum collection (30ml x 5 bottles).', 'Long-lasting premium perfume gift set containing 5 signature fragrances ranging from fresh citrus to woody oriental notes.', '/uploads/image_directory/product_image/7f8ef60f2e-2026-08-07.jpeg', NULL, '1', '1', '1', '1', '1', '1', '2026-08-16 14:00:35', '2026-08-16 14:24:41', NULL);
INSERT INTO `products` (`id`, `category_id`, `sub_category_id`, `name`, `slug`, `sku`, `price`, `previous_price`, `discount_percent`, `stock`, `short_description`, `description`, `thumbnail`, `video_link`, `is_featured`, `is_bestseller`, `is_hot`, `is_new`, `status`, `views`, `created_at`, `updated_at`, `colors`) VALUES ('135', '6', NULL, 'Pant Cut Premium Pajama', 'Pant-Cut-Premium-Pajama-135', 'MSW-PAJ-135', '399', '850', '54', '17439', 'Premium quality cotton pant cut pajama with modern fitting and comfortable waist.', 'Premium Pant Cut Pajama made from 100% fine combed cotton. Features deep pockets, reinforced seams, and breathable fabric suitable for all seasons.', '/uploads/image_directory/product_image/1510192199-2026-05-14.webp', NULL, '1', '1', '1', '1', '1', '5', '2026-08-16 14:00:34', '2026-08-16 17:34:20', NULL);
INSERT INTO `products` (`id`, `category_id`, `sub_category_id`, `name`, `slug`, `sku`, `price`, `previous_price`, `discount_percent`, `stock`, `short_description`, `description`, `thumbnail`, `video_link`, `is_featured`, `is_bestseller`, `is_hot`, `is_new`, `status`, `views`, `created_at`, `updated_at`, `colors`) VALUES ('141', '6', NULL, 'Gentle Belt-Leather', 'Gentle-Belt-Leather-141', 'MSW-BLT-141', '550', '1100', '50', '180', 'Premium top-grain cowhide leather belt with metallic automatic buckle.', 'Durable and formal leather belt crafted from selected full grain hide. Adjustable automatic buckle system for perfect fit.', '/uploads/image_directory/product_image/ad527e7051-2026-05-02.jpeg', NULL, '1', '1', '0', '1', '1', '0', '2026-08-16 14:00:35', '2026-08-16 14:00:35', NULL);
INSERT INTO `products` (`id`, `category_id`, `sub_category_id`, `name`, `slug`, `sku`, `price`, `previous_price`, `discount_percent`, `stock`, `short_description`, `description`, `thumbnail`, `video_link`, `is_featured`, `is_bestseller`, `is_hot`, `is_new`, `status`, `views`, `created_at`, `updated_at`, `colors`) VALUES ('142', '6', NULL, 'Men''s Premium Drawstring Comfort Pants', 'mens-premium-drawstring-comfort-pants-white-103', 'MSW-QQS3ZA', '499', '800', '38', '900', 'Elevated Fabric:
Forget stiff, casual trousers. This premium white fabric has a subtle weight and a smooth, matte texture that immediately suggests quality. It offers excellent opacity, which is a critical feature for white pants, ensuring a clean, confident look. The material drapes beautifully, providing structure without the rigidness of traditional chinos.', 'These are not just "comfy pants." They are a sophisticated investment piece for your spring and summer wardrobe. They solve the challenge of looking polished while feeling completely at ease, striking a perfect balance between luxury and everyday practicality.', 'uploads/products/1786878064_Gemini_Generated_Image_cblvlvcblvlvcblv.jpg', NULL, '1', '1', '0', '1', '1', '9', '2026-08-16 17:01:04', '2026-08-16 17:28:41', 'White');

-- Table: product_galleries
DROP TABLE IF EXISTS `product_galleries`;
CREATE TABLE `product_galleries` (`id` integer primary key autoincrement not null, `product_id` integer not null, `image` varchar not null, `created_at` datetime, `updated_at` datetime, foreign key(`product_id`) references `products`(`id`) on delete cascade);

-- Data for: product_galleries
INSERT INTO `product_galleries` (`id`, `product_id`, `image`, `created_at`, `updated_at`) VALUES ('1', '135', '/uploads/image_directory/product_image/1510192199-2026-05-14.webp', '2026-08-16 14:00:34', '2026-08-16 14:00:34');
INSERT INTO `product_galleries` (`id`, `product_id`, `image`, `created_at`, `updated_at`) VALUES ('2', '26', '/uploads/image_directory/product_image/94c8ab818d-2026-03-13.webp', '2026-08-16 14:00:34', '2026-08-16 14:00:34');
INSERT INTO `product_galleries` (`id`, `product_id`, `image`, `created_at`, `updated_at`) VALUES ('3', '72', '/uploads/image_directory/product_image/ba344ec300-2026-02-23.jpg', '2026-08-16 14:00:35', '2026-08-16 14:00:35');
INSERT INTO `product_galleries` (`id`, `product_id`, `image`, `created_at`, `updated_at`) VALUES ('4', '87', '/uploads/image_directory/product_image/8794df99b8-2026-05-02.webp', '2026-08-16 14:00:35', '2026-08-16 14:00:35');
INSERT INTO `product_galleries` (`id`, `product_id`, `image`, `created_at`, `updated_at`) VALUES ('5', '84', '/uploads/image_directory/product_image/0821823ca6-2025-12-24.png', '2026-08-16 14:00:35', '2026-08-16 14:00:35');
INSERT INTO `product_galleries` (`id`, `product_id`, `image`, `created_at`, `updated_at`) VALUES ('6', '82', '/uploads/image_directory/product_image/2b83726ac6-2026-02-16.jpg', '2026-08-16 14:00:35', '2026-08-16 14:00:35');
INSERT INTO `product_galleries` (`id`, `product_id`, `image`, `created_at`, `updated_at`) VALUES ('7', '141', '/uploads/image_directory/product_image/ad527e7051-2026-05-02.jpeg', '2026-08-16 14:00:35', '2026-08-16 14:00:35');
INSERT INTO `product_galleries` (`id`, `product_id`, `image`, `created_at`, `updated_at`) VALUES ('8', '114', '/uploads/image_directory/product_image/7f8ef60f2e-2026-08-07.jpeg', '2026-08-16 14:00:35', '2026-08-16 14:00:35');

-- Table: product_attributes
DROP TABLE IF EXISTS `product_attributes`;
CREATE TABLE `product_attributes` (`id` integer primary key autoincrement not null, `product_id` integer not null, `name` varchar not null, `created_at` datetime, `updated_at` datetime, foreign key(`product_id`) references `products`(`id`) on delete cascade);

-- Data for: product_attributes
INSERT INTO `product_attributes` (`id`, `product_id`, `name`, `created_at`, `updated_at`) VALUES ('1', '135', 'Size', '2026-08-16 14:00:34', '2026-08-16 14:00:34');
INSERT INTO `product_attributes` (`id`, `product_id`, `name`, `created_at`, `updated_at`) VALUES ('2', '26', 'Size', '2026-08-16 14:00:34', '2026-08-16 14:00:34');
INSERT INTO `product_attributes` (`id`, `product_id`, `name`, `created_at`, `updated_at`) VALUES ('3', '72', 'Size', '2026-08-16 14:00:35', '2026-08-16 14:00:35');
INSERT INTO `product_attributes` (`id`, `product_id`, `name`, `created_at`, `updated_at`) VALUES ('4', '87', 'Size', '2026-08-16 14:00:35', '2026-08-16 14:00:35');
INSERT INTO `product_attributes` (`id`, `product_id`, `name`, `created_at`, `updated_at`) VALUES ('5', '84', 'Size', '2026-08-16 14:00:35', '2026-08-16 14:00:35');
INSERT INTO `product_attributes` (`id`, `product_id`, `name`, `created_at`, `updated_at`) VALUES ('6', '141', 'Size', '2026-08-16 14:00:35', '2026-08-16 14:00:35');

-- Table: product_attribute_values
DROP TABLE IF EXISTS `product_attribute_values`;
CREATE TABLE `product_attribute_values` (`id` integer primary key autoincrement not null, `attribute_id` integer not null, `value` varchar not null, `created_at` datetime, `updated_at` datetime, foreign key(`attribute_id`) references `product_attributes`(`id`) on delete cascade);

-- Data for: product_attribute_values
INSERT INTO `product_attribute_values` (`id`, `attribute_id`, `value`, `created_at`, `updated_at`) VALUES ('1', '1', 'M (38)', '2026-08-16 14:00:34', '2026-08-16 14:00:34');
INSERT INTO `product_attribute_values` (`id`, `attribute_id`, `value`, `created_at`, `updated_at`) VALUES ('2', '1', 'L (40)', '2026-08-16 14:00:34', '2026-08-16 14:00:34');
INSERT INTO `product_attribute_values` (`id`, `attribute_id`, `value`, `created_at`, `updated_at`) VALUES ('3', '1', 'XL (42)', '2026-08-16 14:00:34', '2026-08-16 14:00:34');
INSERT INTO `product_attribute_values` (`id`, `attribute_id`, `value`, `created_at`, `updated_at`) VALUES ('4', '1', 'XXL (44)', '2026-08-16 14:00:34', '2026-08-16 14:00:34');
INSERT INTO `product_attribute_values` (`id`, `attribute_id`, `value`, `created_at`, `updated_at`) VALUES ('5', '2', 'M (38)', '2026-08-16 14:00:34', '2026-08-16 14:00:34');
INSERT INTO `product_attribute_values` (`id`, `attribute_id`, `value`, `created_at`, `updated_at`) VALUES ('6', '2', 'L (40)', '2026-08-16 14:00:34', '2026-08-16 14:00:34');
INSERT INTO `product_attribute_values` (`id`, `attribute_id`, `value`, `created_at`, `updated_at`) VALUES ('7', '2', 'XL (42)', '2026-08-16 14:00:34', '2026-08-16 14:00:34');
INSERT INTO `product_attribute_values` (`id`, `attribute_id`, `value`, `created_at`, `updated_at`) VALUES ('8', '2', 'XXL (44)', '2026-08-16 14:00:34', '2026-08-16 14:00:34');
INSERT INTO `product_attribute_values` (`id`, `attribute_id`, `value`, `created_at`, `updated_at`) VALUES ('9', '3', 'M (38)', '2026-08-16 14:00:35', '2026-08-16 14:00:35');
INSERT INTO `product_attribute_values` (`id`, `attribute_id`, `value`, `created_at`, `updated_at`) VALUES ('10', '3', 'L (40)', '2026-08-16 14:00:35', '2026-08-16 14:00:35');
INSERT INTO `product_attribute_values` (`id`, `attribute_id`, `value`, `created_at`, `updated_at`) VALUES ('11', '3', 'XL (42)', '2026-08-16 14:00:35', '2026-08-16 14:00:35');
INSERT INTO `product_attribute_values` (`id`, `attribute_id`, `value`, `created_at`, `updated_at`) VALUES ('12', '3', 'XXL (44)', '2026-08-16 14:00:35', '2026-08-16 14:00:35');
INSERT INTO `product_attribute_values` (`id`, `attribute_id`, `value`, `created_at`, `updated_at`) VALUES ('13', '4', 'M (38)', '2026-08-16 14:00:35', '2026-08-16 14:00:35');
INSERT INTO `product_attribute_values` (`id`, `attribute_id`, `value`, `created_at`, `updated_at`) VALUES ('14', '4', 'L (40)', '2026-08-16 14:00:35', '2026-08-16 14:00:35');
INSERT INTO `product_attribute_values` (`id`, `attribute_id`, `value`, `created_at`, `updated_at`) VALUES ('15', '4', 'XL (42)', '2026-08-16 14:00:35', '2026-08-16 14:00:35');
INSERT INTO `product_attribute_values` (`id`, `attribute_id`, `value`, `created_at`, `updated_at`) VALUES ('16', '4', 'XXL (44)', '2026-08-16 14:00:35', '2026-08-16 14:00:35');
INSERT INTO `product_attribute_values` (`id`, `attribute_id`, `value`, `created_at`, `updated_at`) VALUES ('17', '5', 'M (38)', '2026-08-16 14:00:35', '2026-08-16 14:00:35');
INSERT INTO `product_attribute_values` (`id`, `attribute_id`, `value`, `created_at`, `updated_at`) VALUES ('18', '5', 'L (40)', '2026-08-16 14:00:35', '2026-08-16 14:00:35');
INSERT INTO `product_attribute_values` (`id`, `attribute_id`, `value`, `created_at`, `updated_at`) VALUES ('19', '5', 'XL (42)', '2026-08-16 14:00:35', '2026-08-16 14:00:35');
INSERT INTO `product_attribute_values` (`id`, `attribute_id`, `value`, `created_at`, `updated_at`) VALUES ('20', '5', 'XXL (44)', '2026-08-16 14:00:35', '2026-08-16 14:00:35');
INSERT INTO `product_attribute_values` (`id`, `attribute_id`, `value`, `created_at`, `updated_at`) VALUES ('21', '6', 'M (38)', '2026-08-16 14:00:35', '2026-08-16 14:00:35');
INSERT INTO `product_attribute_values` (`id`, `attribute_id`, `value`, `created_at`, `updated_at`) VALUES ('22', '6', 'L (40)', '2026-08-16 14:00:35', '2026-08-16 14:00:35');
INSERT INTO `product_attribute_values` (`id`, `attribute_id`, `value`, `created_at`, `updated_at`) VALUES ('23', '6', 'XL (42)', '2026-08-16 14:00:35', '2026-08-16 14:00:35');
INSERT INTO `product_attribute_values` (`id`, `attribute_id`, `value`, `created_at`, `updated_at`) VALUES ('24', '6', 'XXL (44)', '2026-08-16 14:00:35', '2026-08-16 14:00:35');

-- Table: product_variants
DROP TABLE IF EXISTS `product_variants`;
CREATE TABLE `product_variants` (`id` integer primary key autoincrement not null, `product_id` integer not null, `variant_name` varchar not null, `price` numeric, `stock` integer not null default '50', `sku` varchar, `image` varchar, `attr_info` text, `status` tinyint(1) not null default '1', `created_at` datetime, `updated_at` datetime, foreign key(`product_id`) references `products`(`id`) on delete cascade);

-- Data for: product_variants
INSERT INTO `product_variants` (`id`, `product_id`, `variant_name`, `price`, `stock`, `sku`, `image`, `attr_info`, `status`, `created_at`, `updated_at`) VALUES ('1', '135', 'M (38)', '399', '50', NULL, NULL, '{"Size":"M (38)"}', '1', '2026-08-16 14:00:34', '2026-08-16 14:00:34');
INSERT INTO `product_variants` (`id`, `product_id`, `variant_name`, `price`, `stock`, `sku`, `image`, `attr_info`, `status`, `created_at`, `updated_at`) VALUES ('2', '135', 'L (40)', '399', '50', NULL, NULL, '{"Size":"L (40)"}', '1', '2026-08-16 14:00:34', '2026-08-16 14:00:34');
INSERT INTO `product_variants` (`id`, `product_id`, `variant_name`, `price`, `stock`, `sku`, `image`, `attr_info`, `status`, `created_at`, `updated_at`) VALUES ('3', '135', 'XL (42)', '399', '50', NULL, NULL, '{"Size":"XL (42)"}', '1', '2026-08-16 14:00:34', '2026-08-16 14:00:34');
INSERT INTO `product_variants` (`id`, `product_id`, `variant_name`, `price`, `stock`, `sku`, `image`, `attr_info`, `status`, `created_at`, `updated_at`) VALUES ('4', '135', 'XXL (44)', '399', '50', NULL, NULL, '{"Size":"XXL (44)"}', '1', '2026-08-16 14:00:34', '2026-08-16 14:00:34');
INSERT INTO `product_variants` (`id`, `product_id`, `variant_name`, `price`, `stock`, `sku`, `image`, `attr_info`, `status`, `created_at`, `updated_at`) VALUES ('5', '26', 'M (38)', '450', '50', NULL, NULL, '{"Size":"M (38)"}', '1', '2026-08-16 14:00:34', '2026-08-16 14:00:34');
INSERT INTO `product_variants` (`id`, `product_id`, `variant_name`, `price`, `stock`, `sku`, `image`, `attr_info`, `status`, `created_at`, `updated_at`) VALUES ('6', '26', 'L (40)', '450', '50', NULL, NULL, '{"Size":"L (40)"}', '1', '2026-08-16 14:00:34', '2026-08-16 14:00:34');
INSERT INTO `product_variants` (`id`, `product_id`, `variant_name`, `price`, `stock`, `sku`, `image`, `attr_info`, `status`, `created_at`, `updated_at`) VALUES ('7', '26', 'XL (42)', '450', '50', NULL, NULL, '{"Size":"XL (42)"}', '1', '2026-08-16 14:00:34', '2026-08-16 14:00:34');
INSERT INTO `product_variants` (`id`, `product_id`, `variant_name`, `price`, `stock`, `sku`, `image`, `attr_info`, `status`, `created_at`, `updated_at`) VALUES ('8', '26', 'XXL (44)', '450', '50', NULL, NULL, '{"Size":"XXL (44)"}', '1', '2026-08-16 14:00:35', '2026-08-16 14:00:35');
INSERT INTO `product_variants` (`id`, `product_id`, `variant_name`, `price`, `stock`, `sku`, `image`, `attr_info`, `status`, `created_at`, `updated_at`) VALUES ('9', '72', 'M (38)', '350', '50', NULL, NULL, '{"Size":"M (38)"}', '1', '2026-08-16 14:00:35', '2026-08-16 14:00:35');
INSERT INTO `product_variants` (`id`, `product_id`, `variant_name`, `price`, `stock`, `sku`, `image`, `attr_info`, `status`, `created_at`, `updated_at`) VALUES ('10', '72', 'L (40)', '350', '50', NULL, NULL, '{"Size":"L (40)"}', '1', '2026-08-16 14:00:35', '2026-08-16 14:00:35');
INSERT INTO `product_variants` (`id`, `product_id`, `variant_name`, `price`, `stock`, `sku`, `image`, `attr_info`, `status`, `created_at`, `updated_at`) VALUES ('11', '72', 'XL (42)', '350', '50', NULL, NULL, '{"Size":"XL (42)"}', '1', '2026-08-16 14:00:35', '2026-08-16 14:00:35');
INSERT INTO `product_variants` (`id`, `product_id`, `variant_name`, `price`, `stock`, `sku`, `image`, `attr_info`, `status`, `created_at`, `updated_at`) VALUES ('12', '72', 'XXL (44)', '350', '50', NULL, NULL, '{"Size":"XXL (44)"}', '1', '2026-08-16 14:00:35', '2026-08-16 14:00:35');
INSERT INTO `product_variants` (`id`, `product_id`, `variant_name`, `price`, `stock`, `sku`, `image`, `attr_info`, `status`, `created_at`, `updated_at`) VALUES ('13', '87', 'M (38)', '1250', '50', NULL, NULL, '{"Size":"M (38)"}', '1', '2026-08-16 14:00:35', '2026-08-16 14:00:35');
INSERT INTO `product_variants` (`id`, `product_id`, `variant_name`, `price`, `stock`, `sku`, `image`, `attr_info`, `status`, `created_at`, `updated_at`) VALUES ('14', '87', 'L (40)', '1250', '50', NULL, NULL, '{"Size":"L (40)"}', '1', '2026-08-16 14:00:35', '2026-08-16 14:00:35');
INSERT INTO `product_variants` (`id`, `product_id`, `variant_name`, `price`, `stock`, `sku`, `image`, `attr_info`, `status`, `created_at`, `updated_at`) VALUES ('15', '87', 'XL (42)', '1250', '50', NULL, NULL, '{"Size":"XL (42)"}', '1', '2026-08-16 14:00:35', '2026-08-16 14:00:35');
INSERT INTO `product_variants` (`id`, `product_id`, `variant_name`, `price`, `stock`, `sku`, `image`, `attr_info`, `status`, `created_at`, `updated_at`) VALUES ('16', '87', 'XXL (44)', '1250', '50', NULL, NULL, '{"Size":"XXL (44)"}', '1', '2026-08-16 14:00:35', '2026-08-16 14:00:35');
INSERT INTO `product_variants` (`id`, `product_id`, `variant_name`, `price`, `stock`, `sku`, `image`, `attr_info`, `status`, `created_at`, `updated_at`) VALUES ('17', '84', 'M (38)', '1850', '50', NULL, NULL, '{"Size":"M (38)"}', '1', '2026-08-16 14:00:35', '2026-08-16 14:00:35');
INSERT INTO `product_variants` (`id`, `product_id`, `variant_name`, `price`, `stock`, `sku`, `image`, `attr_info`, `status`, `created_at`, `updated_at`) VALUES ('18', '84', 'L (40)', '1850', '50', NULL, NULL, '{"Size":"L (40)"}', '1', '2026-08-16 14:00:35', '2026-08-16 14:00:35');
INSERT INTO `product_variants` (`id`, `product_id`, `variant_name`, `price`, `stock`, `sku`, `image`, `attr_info`, `status`, `created_at`, `updated_at`) VALUES ('19', '84', 'XL (42)', '1850', '50', NULL, NULL, '{"Size":"XL (42)"}', '1', '2026-08-16 14:00:35', '2026-08-16 14:00:35');
INSERT INTO `product_variants` (`id`, `product_id`, `variant_name`, `price`, `stock`, `sku`, `image`, `attr_info`, `status`, `created_at`, `updated_at`) VALUES ('20', '84', 'XXL (44)', '1850', '50', NULL, NULL, '{"Size":"XXL (44)"}', '1', '2026-08-16 14:00:35', '2026-08-16 14:00:35');
INSERT INTO `product_variants` (`id`, `product_id`, `variant_name`, `price`, `stock`, `sku`, `image`, `attr_info`, `status`, `created_at`, `updated_at`) VALUES ('21', '141', 'M (38)', '550', '50', NULL, NULL, '{"Size":"M (38)"}', '1', '2026-08-16 14:00:35', '2026-08-16 14:00:35');
INSERT INTO `product_variants` (`id`, `product_id`, `variant_name`, `price`, `stock`, `sku`, `image`, `attr_info`, `status`, `created_at`, `updated_at`) VALUES ('22', '141', 'L (40)', '550', '50', NULL, NULL, '{"Size":"L (40)"}', '1', '2026-08-16 14:00:35', '2026-08-16 14:00:35');
INSERT INTO `product_variants` (`id`, `product_id`, `variant_name`, `price`, `stock`, `sku`, `image`, `attr_info`, `status`, `created_at`, `updated_at`) VALUES ('23', '141', 'XL (42)', '550', '50', NULL, NULL, '{"Size":"XL (42)"}', '1', '2026-08-16 14:00:35', '2026-08-16 14:00:35');
INSERT INTO `product_variants` (`id`, `product_id`, `variant_name`, `price`, `stock`, `sku`, `image`, `attr_info`, `status`, `created_at`, `updated_at`) VALUES ('24', '141', 'XXL (44)', '550', '50', NULL, NULL, '{"Size":"XXL (44)"}', '1', '2026-08-16 14:00:35', '2026-08-16 14:00:35');

-- Table: orders
DROP TABLE IF EXISTS `orders`;
CREATE TABLE `orders` (`id` integer primary key autoincrement not null, `order_number` varchar not null, `user_id` integer, `customer_name` varchar not null, `phone` varchar not null, `alt_phone` varchar, `email` varchar, `district` varchar, `upazila` varchar, `address` text not null, `subtotal` numeric not null, `shipping_cost` numeric not null default '0', `discount` numeric not null default '0', `grand_total` numeric not null, `payment_method` varchar not null default 'Cash on Delivery', `payment_status` varchar not null default 'Pending', `order_status` varchar not null default 'Pending', `order_notes` text, `transaction_id` varchar, `created_at` datetime, `updated_at` datetime, foreign key(`user_id`) references `users`(`id`) on delete set null);

-- Data for: orders
INSERT INTO `orders` (`id`, `order_number`, `user_id`, `customer_name`, `phone`, `alt_phone`, `email`, `district`, `upazila`, `address`, `subtotal`, `shipping_cost`, `discount`, `grand_total`, `payment_method`, `payment_status`, `order_status`, `order_notes`, `transaction_id`, `created_at`, `updated_at`) VALUES ('1', 'MSW-260816-2533', '2', 'Regina Akhter', '01712345678', '01712345678', NULL, 'Rangpur', 'Regina Akhter', 'Regina Akhter', '350', '120', '0', '470', 'Cash on Delivery', 'Pending', 'Pending', 'Regina Akhter', NULL, '2026-08-16 14:08:28', '2026-08-16 14:08:28');
INSERT INTO `orders` (`id`, `order_number`, `user_id`, `customer_name`, `phone`, `alt_phone`, `email`, `district`, `upazila`, `address`, `subtotal`, `shipping_cost`, `discount`, `grand_total`, `payment_method`, `payment_status`, `order_status`, `order_notes`, `transaction_id`, `created_at`, `updated_at`) VALUES ('2', 'MSW-260816-5609', '2', 'Regina Akhter', '01712345678', NULL, NULL, 'Barishal', NULL, 'fififififififififififififififififi', '350', '120', '0', '470', 'Cash on Delivery', 'Pending', 'Processing', NULL, NULL, '2026-08-16 16:15:50', '2026-08-16 16:16:59');
INSERT INTO `orders` (`id`, `order_number`, `user_id`, `customer_name`, `phone`, `alt_phone`, `email`, `district`, `upazila`, `address`, `subtotal`, `shipping_cost`, `discount`, `grand_total`, `payment_method`, `payment_status`, `order_status`, `order_notes`, `transaction_id`, `created_at`, `updated_at`) VALUES ('3', 'MSW-260816-8277', '2', 'Regina Akhter', '01712345678', NULL, NULL, 'Inside Dhaka', NULL, 'fififififififififififififififififi', '350', '80', '0', '430', 'Cash on Delivery', 'Pending', 'Pending', NULL, NULL, '2026-08-16 16:43:08', '2026-08-16 16:43:08');

-- Table: order_items
DROP TABLE IF EXISTS `order_items`;
CREATE TABLE `order_items` (`id` integer primary key autoincrement not null, `order_id` integer not null, `product_id` integer, `variant_id` integer, `product_name` varchar not null, `variant_name` varchar, `product_image` varchar, `price` numeric not null, `quantity` integer not null default '1', `subtotal` numeric not null, `created_at` datetime, `updated_at` datetime, foreign key(`order_id`) references `orders`(`id`) on delete cascade, foreign key(`product_id`) references `products`(`id`) on delete set null, foreign key(`variant_id`) references `product_variants`(`id`) on delete set null);

-- Data for: order_items
INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `variant_id`, `product_name`, `variant_name`, `product_image`, `price`, `quantity`, `subtotal`, `created_at`, `updated_at`) VALUES ('1', '1', '72', '11', 'T-Shirt (Rubber Printed)', 'XL (42)', '/uploads/image_directory/product_image/ba344ec300-2026-02-23.jpg', '350', '1', '350', '2026-08-16 14:08:28', '2026-08-16 14:08:28');
INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `variant_id`, `product_name`, `variant_name`, `product_image`, `price`, `quantity`, `subtotal`, `created_at`, `updated_at`) VALUES ('2', '2', '72', '9', 'comfort pant(Rubber)', 'M (38), Color: White', 'uploads/products/1786874721_pant.jpeg', '350', '1', '350', '2026-08-16 16:15:50', '2026-08-16 16:15:50');
INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `variant_id`, `product_name`, `variant_name`, `product_image`, `price`, `quantity`, `subtotal`, `created_at`, `updated_at`) VALUES ('3', '3', '72', '9', 'comfort pant(Rubber)', 'M (38), Color: White', 'uploads/products/1786874721_pant.jpeg', '350', '1', '350', '2026-08-16 16:43:08', '2026-08-16 16:43:08');

-- Table: districts
DROP TABLE IF EXISTS `districts`;
CREATE TABLE `districts` (`id` integer primary key autoincrement not null, `name` varchar not null, `bn_name` varchar, `shipping_cost` numeric not null default '100', `created_at` datetime, `updated_at` datetime);

-- Data for: districts
INSERT INTO `districts` (`id`, `name`, `bn_name`, `shipping_cost`, `created_at`, `updated_at`) VALUES ('1', 'Dhaka', 'ঢাকা', '60', '2026-08-16 14:00:34', '2026-08-16 14:00:34');
INSERT INTO `districts` (`id`, `name`, `bn_name`, `shipping_cost`, `created_at`, `updated_at`) VALUES ('2', 'Chattogram', 'চট্টগ্রাম', '120', '2026-08-16 14:00:34', '2026-08-16 14:00:34');
INSERT INTO `districts` (`id`, `name`, `bn_name`, `shipping_cost`, `created_at`, `updated_at`) VALUES ('3', 'Sylhet', 'সিলেট', '120', '2026-08-16 14:00:34', '2026-08-16 14:00:34');
INSERT INTO `districts` (`id`, `name`, `bn_name`, `shipping_cost`, `created_at`, `updated_at`) VALUES ('4', 'Rajshahi', 'রাজশাহী', '120', '2026-08-16 14:00:34', '2026-08-16 14:00:34');
INSERT INTO `districts` (`id`, `name`, `bn_name`, `shipping_cost`, `created_at`, `updated_at`) VALUES ('5', 'Khulna', 'খুলনা', '120', '2026-08-16 14:00:34', '2026-08-16 14:00:34');
INSERT INTO `districts` (`id`, `name`, `bn_name`, `shipping_cost`, `created_at`, `updated_at`) VALUES ('6', 'Barishal', 'বরিশাল', '120', '2026-08-16 14:00:34', '2026-08-16 14:00:34');
INSERT INTO `districts` (`id`, `name`, `bn_name`, `shipping_cost`, `created_at`, `updated_at`) VALUES ('7', 'Rangpur', 'রংপুর', '120', '2026-08-16 14:00:34', '2026-08-16 14:00:34');
INSERT INTO `districts` (`id`, `name`, `bn_name`, `shipping_cost`, `created_at`, `updated_at`) VALUES ('8', 'Mymensingh', 'ময়মনসিংহ', '120', '2026-08-16 14:00:34', '2026-08-16 14:00:34');
INSERT INTO `districts` (`id`, `name`, `bn_name`, `shipping_cost`, `created_at`, `updated_at`) VALUES ('9', 'Gazipur', 'গাজীপুর', '80', '2026-08-16 14:00:34', '2026-08-16 14:00:34');
INSERT INTO `districts` (`id`, `name`, `bn_name`, `shipping_cost`, `created_at`, `updated_at`) VALUES ('10', 'Narayanganj', 'নারায়ণগঞ্জ', '80', '2026-08-16 14:00:34', '2026-08-16 14:00:34');
INSERT INTO `districts` (`id`, `name`, `bn_name`, `shipping_cost`, `created_at`, `updated_at`) VALUES ('11', 'Cumilla', 'কুমিল্লা', '120', '2026-08-16 14:00:34', '2026-08-16 14:00:34');
INSERT INTO `districts` (`id`, `name`, `bn_name`, `shipping_cost`, `created_at`, `updated_at`) VALUES ('12', 'Bogura', 'বগুড়া', '120', '2026-08-16 14:00:34', '2026-08-16 14:00:34');

-- Table: upazilas
DROP TABLE IF EXISTS `upazilas`;
CREATE TABLE `upazilas` (`id` integer primary key autoincrement not null, `district_id` integer not null, `name` varchar not null, `bn_name` varchar, `created_at` datetime, `updated_at` datetime, foreign key(`district_id`) references `districts`(`id`) on delete cascade);

-- Data for: upazilas
INSERT INTO `upazilas` (`id`, `district_id`, `name`, `bn_name`, `created_at`, `updated_at`) VALUES ('1', '1', 'Dhaka Sadar', 'ঢাকা সদর', '2026-08-16 14:00:34', '2026-08-16 14:00:34');
INSERT INTO `upazilas` (`id`, `district_id`, `name`, `bn_name`, `created_at`, `updated_at`) VALUES ('2', '2', 'Chattogram Sadar', 'চট্টগ্রাম সদর', '2026-08-16 14:00:34', '2026-08-16 14:00:34');
INSERT INTO `upazilas` (`id`, `district_id`, `name`, `bn_name`, `created_at`, `updated_at`) VALUES ('3', '3', 'Sylhet Sadar', 'সিলেট সদর', '2026-08-16 14:00:34', '2026-08-16 14:00:34');
INSERT INTO `upazilas` (`id`, `district_id`, `name`, `bn_name`, `created_at`, `updated_at`) VALUES ('4', '4', 'Rajshahi Sadar', 'রাজশাহী সদর', '2026-08-16 14:00:34', '2026-08-16 14:00:34');
INSERT INTO `upazilas` (`id`, `district_id`, `name`, `bn_name`, `created_at`, `updated_at`) VALUES ('5', '5', 'Khulna Sadar', 'খুলনা সদর', '2026-08-16 14:00:34', '2026-08-16 14:00:34');
INSERT INTO `upazilas` (`id`, `district_id`, `name`, `bn_name`, `created_at`, `updated_at`) VALUES ('6', '6', 'Barishal Sadar', 'বরিশাল সদর', '2026-08-16 14:00:34', '2026-08-16 14:00:34');
INSERT INTO `upazilas` (`id`, `district_id`, `name`, `bn_name`, `created_at`, `updated_at`) VALUES ('7', '7', 'Rangpur Sadar', 'রংপুর সদর', '2026-08-16 14:00:34', '2026-08-16 14:00:34');
INSERT INTO `upazilas` (`id`, `district_id`, `name`, `bn_name`, `created_at`, `updated_at`) VALUES ('8', '8', 'Mymensingh Sadar', 'ময়মনসিংহ সদর', '2026-08-16 14:00:34', '2026-08-16 14:00:34');
INSERT INTO `upazilas` (`id`, `district_id`, `name`, `bn_name`, `created_at`, `updated_at`) VALUES ('9', '9', 'Gazipur Sadar', 'গাজীপুর সদর', '2026-08-16 14:00:34', '2026-08-16 14:00:34');
INSERT INTO `upazilas` (`id`, `district_id`, `name`, `bn_name`, `created_at`, `updated_at`) VALUES ('10', '10', 'Narayanganj Sadar', 'নারায়ণগঞ্জ সদর', '2026-08-16 14:00:34', '2026-08-16 14:00:34');
INSERT INTO `upazilas` (`id`, `district_id`, `name`, `bn_name`, `created_at`, `updated_at`) VALUES ('11', '11', 'Cumilla Sadar', 'কুমিল্লা সদর', '2026-08-16 14:00:34', '2026-08-16 14:00:34');
INSERT INTO `upazilas` (`id`, `district_id`, `name`, `bn_name`, `created_at`, `updated_at`) VALUES ('12', '12', 'Bogura Sadar', 'বগুড়া সদর', '2026-08-16 14:00:34', '2026-08-16 14:00:34');

-- Table: coupons
DROP TABLE IF EXISTS `coupons`;
CREATE TABLE `coupons` (`id` integer primary key autoincrement not null, `code` varchar not null, `type` varchar not null default 'fixed', `value` numeric not null, `min_purchase` numeric not null default '0', `start_date` date, `expire_date` date, `status` tinyint(1) not null default '1', `created_at` datetime, `updated_at` datetime);

-- Table: pages
DROP TABLE IF EXISTS `pages`;
CREATE TABLE `pages` (`id` integer primary key autoincrement not null, `title` varchar not null, `slug` varchar not null, `content` text not null, `status` tinyint(1) not null default '1', `created_at` datetime, `updated_at` datetime);

-- Data for: pages
INSERT INTO `pages` (`id`, `title`, `slug`, `content`, `status`, `created_at`, `updated_at`) VALUES ('1', 'About Us', 'About-Us-2', '<h3>About Miswan Fashion</h3><p>Miswan Fashion is one of the leading lifestyle and fashion e-commerce platforms in Bangladesh, delivering premium quality apparel, fragrances, and accessories directly to your doorstep with guaranteed authenticity.</p>', '1', '2026-08-16 14:00:34', '2026-08-16 14:00:34');
INSERT INTO `pages` (`id`, `title`, `slug`, `content`, `status`, `created_at`, `updated_at`) VALUES ('2', 'Terms & Conditions', 'Terms-&-Conditions-4', '<h3>Terms and Conditions</h3><p>Welcome to Miswan Fashion. By accessing and placing an order on our platform, you agree to our standard terms of service, delivery policies, and cash-on-delivery guidelines.</p>', '1', '2026-08-16 14:00:34', '2026-08-16 14:00:34');
INSERT INTO `pages` (`id`, `title`, `slug`, `content`, `status`, `created_at`, `updated_at`) VALUES ('3', 'Refund & Return Policy', 'Refund-&-Return-Policy-5', '<h3>Return & Refund Policy</h3><p>We provide a 7-day hassle-free return policy if you receive a damaged, defective, or incorrect product. Please contact customer support with your invoice number to initiate a return.</p>', '1', '2026-08-16 14:00:34', '2026-08-16 14:00:34');
INSERT INTO `pages` (`id`, `title`, `slug`, `content`, `status`, `created_at`, `updated_at`) VALUES ('4', 'Privacy Policy', 'Privacy-Policy-3', '<h3>Privacy Policy</h3><p>We respect your privacy and protect your personal data. We will never sell or share your contact numbers or addresses with third parties.</p>', '1', '2026-08-16 14:00:34', '2026-08-16 14:00:34');

-- Table: settings
DROP TABLE IF EXISTS `settings`;
CREATE TABLE `settings` (`id` integer primary key autoincrement not null, `site_name` varchar not null default 'Miswan Fashion', `site_title` varchar not null default 'Miswanfashion | Bangladesh’s Leading Fashion Brand', `logo` varchar, `favicon` varchar, `phone` varchar not null default '+8801700000000', `email` varchar not null default 'support@miswanfashion.com', `address` varchar not null default 'Dhaka, Bangladesh', `currency_symbol` varchar not null default 'TK', `shipping_inside_city` numeric not null default '60', `shipping_outside_city` numeric not null default '120', `facebook_url` varchar, `youtube_url` varchar, `instagram_url` varchar, `announcement_text` text, `created_at` datetime, `updated_at` datetime);

-- Data for: settings
INSERT INTO `settings` (`id`, `site_name`, `site_title`, `logo`, `favicon`, `phone`, `email`, `address`, `currency_symbol`, `shipping_inside_city`, `shipping_outside_city`, `facebook_url`, `youtube_url`, `instagram_url`, `announcement_text`, `created_at`, `updated_at`) VALUES ('1', 'Sija world', 'Sijaworld | Bangladesh’s Leading Fashion Brand', 'https://www.sijaworld.com/core/public/storage/images/l4WGlogo.png', '/uploads/image_directory/site/685ed7e04a0218.78429304.png', '01324256517, 01324256518', 'sales@sijaworld.com', '415, (5th Floor) Shahinbag Tejgaon, Dhaka-1215', 'TK', '80', '130', 'https://www.facebook.com/share/1G67yFyBBS/', NULL, NULL, 'Upto 50% Discount on selected product. Ending Soon.', '2026-08-16 14:00:34', '2026-08-16 14:38:17');

-- Table: sliders
DROP TABLE IF EXISTS `sliders`;
CREATE TABLE `sliders` (`id` integer primary key autoincrement not null, `title` varchar, `subtitle` varchar, `link` varchar, `image` varchar not null, `sort_order` integer not null default ('0'), `status` tinyint(1) not null default ('1'), `created_at` datetime, `updated_at` datetime, `product_id` integer, `button_text` varchar, foreign key(`product_id`) references `products`(`id`) on delete set null);

-- Data for: sliders
INSERT INTO `sliders` (`id`, `title`, `subtitle`, `link`, `image`, `sort_order`, `status`, `created_at`, `updated_at`, `product_id`, `button_text`) VALUES ('3', 'Men''s Formal & Casual Fits', 'Premium Chinese Cotton Fabrics', '/product-category/man-fashion', '/uploads/image_directory/banner_image/ead3cd2e4d-2026-02-22.jpg', '3', '1', '2026-08-16 14:00:34', '2026-08-16 14:00:34', NULL, NULL);
INSERT INTO `sliders` (`id`, `title`, `subtitle`, `link`, `image`, `sort_order`, `status`, `created_at`, `updated_at`, `product_id`, `button_text`) VALUES ('4', 'Luxury Perfumes & Fragrances', 'Long Lasting French Fragrance Sets', '/product-category/perfume', '/uploads/image_directory/banner_image/d63e0858df-2026-02-22.jpeg', '4', '1', '2026-08-16 14:00:34', '2026-08-16 14:00:34', NULL, NULL);
INSERT INTO `sliders` (`id`, `title`, `subtitle`, `link`, `image`, `sort_order`, `status`, `created_at`, `updated_at`, `product_id`, `button_text`) VALUES ('6', NULL, NULL, NULL, '/uploads/image_directory/banner_image/sijaworld_slider_2.jpg', '0', '1', '2026-08-16 15:30:15', '2026-08-16 15:30:15', NULL, NULL);
INSERT INTO `sliders` (`id`, `title`, `subtitle`, `link`, `image`, `sort_order`, `status`, `created_at`, `updated_at`, `product_id`, `button_text`) VALUES ('8', 'summer offer', NULL, '/product-category/man-fashion', 'uploads/sliders/1786878681_Gemini_Generated_Image_hf0lhlhf0lhlhf0l.jpg', '1', '1', '2026-08-16 17:11:21', '2026-08-16 17:11:21', NULL, NULL);

-- Table: banners
DROP TABLE IF EXISTS `banners`;
CREATE TABLE `banners` (`id` integer primary key autoincrement not null, `title` varchar, `position` varchar not null, `link` varchar, `image` varchar not null, `status` tinyint(1) not null default ('1'), `created_at` datetime, `updated_at` datetime, `product_id` integer, `subtitle` varchar, `button_text` varchar, foreign key(`product_id`) references `products`(`id`) on delete set null);

-- Data for: banners
INSERT INTO `banners` (`id`, `title`, `position`, `link`, `image`, `status`, `created_at`, `updated_at`, `product_id`, `subtitle`, `button_text`) VALUES ('1', 'Promo Card 1', 'middle_banner', '/product-category/man-fashion', '/uploads/image_directory/banner_image/2f432beec3-2026-02-22.jpeg', '1', '2026-08-16 14:00:34', '2026-08-16 14:00:34', NULL, NULL, NULL);
INSERT INTO `banners` (`id`, `title`, `position`, `link`, `image`, `status`, `created_at`, `updated_at`, `product_id`, `subtitle`, `button_text`) VALUES ('2', 'Promo Card 2', 'middle_banner', '/product-category/fashion-women', '/uploads/image_directory/banner_image/ead3cd2e4d-2026-02-22.jpg', '1', '2026-08-16 14:00:34', '2026-08-16 14:00:34', NULL, NULL, NULL);

