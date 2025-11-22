<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            [
                'product_code' => 'HOST-STARTER-001',
                'name_product' => 'Starter Plan',
                'domain_included' => false,
                'ssh_access' => false,
                'email_feature' => true,
                'database_feature' => true,
                'ssl_included' => true,
                'storage' => 10, // GB
                'bandwidth' => '50 GB',
                'price_original' => 89900.00,
                'price_monthly' => 12900.00,
                'discount_percentage' => 86,
                'free_months' => 0,
                'description' => 'Perfect for personal websites and small blogs.',
                'status' => true,
            ],
            [
                'product_code' => 'HOST-BUSINESS-002',
                'name_product' => 'Business Plan',
                'domain_included' => true,
                'ssh_access' => true,
                'email_feature' => true,
                'database_feature' => true,
                'ssl_included' => true,
                'storage' => 50, // GB
                'bandwidth' => '200 GB',
                'price_original' => 119900.00,
                'price_monthly' => 23900.00,
                'discount_percentage' => 80,
                'free_months' => 2,
                'description' => 'Best for growing businesses',
                'status' => true,
            ],
            [
                'product_code' => 'HOST-ENTERPRISE-003',
                'name_product' => 'Enterprise Plan',
                'domain_included' => true,
                'ssh_access' => true,
                'email_feature' => true,
                'database_feature' => true,
                'ssl_included' => true,
                'storage' => 200, // GB
                'bandwidth' => 'Unlimited',
                'price_original' => 129900.00,
                'price_monthly' => 38900.00,
                'discount_percentage' => 70,
                'free_months' => 2,
                'description' => 'For large-scale operations',
                'status' => true,
            ],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
