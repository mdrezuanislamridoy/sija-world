<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\District;
use App\Models\Upazila;

class DistrictSeeder extends Seeder
{
    public function run(): void
    {
        $districts = [
            ['id' => 1, 'name' => 'Dhaka', 'bn_name' => 'ঢাকা', 'shipping_cost' => 60.00],
            ['id' => 2, 'name' => 'Chattogram', 'bn_name' => 'চট্টগ্রাম', 'shipping_cost' => 120.00],
            ['id' => 3, 'name' => 'Sylhet', 'bn_name' => 'সিলেট', 'shipping_cost' => 120.00],
            ['id' => 4, 'name' => 'Rajshahi', 'bn_name' => 'রাজশাহী', 'shipping_cost' => 120.00],
            ['id' => 5, 'name' => 'Khulna', 'bn_name' => 'খুলনা', 'shipping_cost' => 120.00],
            ['id' => 6, 'name' => 'Barishal', 'bn_name' => 'বরিশাল', 'shipping_cost' => 120.00],
            ['id' => 7, 'name' => 'Rangpur', 'bn_name' => 'রংপুর', 'shipping_cost' => 120.00],
            ['id' => 8, 'name' => 'Mymensingh', 'bn_name' => 'ময়মনসিংহ', 'shipping_cost' => 120.00],
            ['id' => 9, 'name' => 'Gazipur', 'bn_name' => 'গাজীপুর', 'shipping_cost' => 80.00],
            ['id' => 10, 'name' => 'Narayanganj', 'bn_name' => 'নারায়ণগঞ্জ', 'shipping_cost' => 80.00],
            ['id' => 11, 'name' => 'Cumilla', 'bn_name' => 'কুমিল্লা', 'shipping_cost' => 120.00],
            ['id' => 12, 'name' => 'Bogura', 'bn_name' => 'বগুড়া', 'shipping_cost' => 120.00],
        ];

        foreach ($districts as $d) {
            $dist = District::updateOrCreate(['id' => $d['id']], $d);

            Upazila::updateOrCreate(
                ['district_id' => $dist->id, 'name' => $d['name'] . ' Sadar'],
                ['district_id' => $dist->id, 'name' => $d['name'] . ' Sadar', 'bn_name' => $d['bn_name'] . ' সদর']
            );
        }
    }
}
