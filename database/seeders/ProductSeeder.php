<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Products;
use Carbon\Carbon;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            [
                'product_code' => 'SH-BASIC',
                'name_product' => 'Shared Hosting Basic',
                'domain_included' => false,
                'ssh_access' => false,
                'email_feature' => true,
                'database_feature' => true,
                'ssl_included' => true,
                'storage' => 10, // 10 GB
                'price_monthly' => 75000.00,
                'description' => 'Paket hosting dasar dengan fitur lengkap untuk website personal dan bisnis kecil. Termasuk SSL gratis, email unlimited, dan bandwidth unlimited.',
                'status' => true,
                'created_at' => Carbon::now()->subDays(30),
                'updated_at' => Carbon::now()->subDays(30),
            ],
            [
                'product_code' => 'SH-PRO',
                'name_product' => 'Shared Hosting Pro',
                'domain_included' => true,
                'ssh_access' => false,
                'email_feature' => true,
                'database_feature' => true,
                'ssl_included' => true,
                'storage' => 25, // 25 GB
                'price_monthly' => 125000.00,
                'description' => 'Paket hosting profesional dengan performa tinggi dan fitur advance untuk website bisnis menengah dan e-commerce.',
                'status' => true,
                'created_at' => Carbon::now()->subDays(30),
                'updated_at' => Carbon::now()->subDays(20),
            ],
            [
                'product_code' => 'SH-PREMIUM',
                'name_product' => 'Shared Hosting Premium',
                'domain_included' => true,
                'ssh_access' => true,
                'email_feature' => true,
                'database_feature' => true,
                'ssl_included' => true,
                'storage' => 50, // 50 GB
                'price_monthly' => 200000.00,
                'description' => 'Paket hosting premium dengan resource maksimal dan fitur enterprise untuk website dengan traffic tinggi.',
                'status' => true,
                'created_at' => Carbon::now()->subDays(30),
                'updated_at' => Carbon::now()->subDays(15),
            ],
            [
                'product_code' => 'VPS-BASIC',
                'name_product' => 'Cloud VPS Basic',
                'domain_included' => false,
                'ssh_access' => true,
                'email_feature' => false,
                'database_feature' => true,
                'ssl_included' => false,
                'storage' => 50, // 50 GB SSD
                'price_monthly' => 350000.00,
                'description' => 'Virtual Private Server dengan resource dedicated dan kontrol penuh untuk developer dan aplikasi custom.',
                'status' => true,
                'created_at' => Carbon::now()->subDays(25),
                'updated_at' => Carbon::now()->subDays(10),
            ],
            [
                'product_code' => 'VPS-PRO',
                'name_product' => 'Cloud VPS Pro',
                'domain_included' => false,
                'ssh_access' => true,
                'email_feature' => false,
                'database_feature' => true,
                'ssl_included' => true,
                'storage' => 100, // 100 GB SSD
                'price_monthly' => 650000.00,
                'description' => 'VPS dengan spesifikasi tinggi untuk aplikasi enterprise dan website dengan performa maksimal.',
                'status' => true,
                'created_at' => Carbon::now()->subDays(25),
                'updated_at' => Carbon::now()->subDays(5),
            ],
            [
                'product_code' => 'DS-ENTERPRISE',
                'name_product' => 'Dedicated Server',
                'domain_included' => false,
                'ssh_access' => true,
                'email_feature' => false,
                'database_feature' => true,
                'ssl_included' => true,
                'storage' => 1000, // 1000 GB (1TB) SSD
                'price_monthly' => 1500000.00,
                'description' => 'Server fisik dedicated dengan performa maksimal untuk enterprise dan aplikasi mission critical.',
                'status' => true,
                'created_at' => Carbon::now()->subDays(20),
                'updated_at' => Carbon::now()->subDays(3),
            ],
            [
                'product_code' => 'WP-HOSTING',
                'name_product' => 'WordPress Hosting',
                'domain_included' => true,
                'ssh_access' => false,
                'email_feature' => true,
                'database_feature' => true,
                'ssl_included' => true,
                'storage' => 15, // 15 GB
                'price_monthly' => 95000.00,
                'description' => 'Hosting khusus WordPress dengan optimasi performa dan keamanan terbaik untuk website WordPress.',
                'status' => true,
                'created_at' => Carbon::now()->subDays(15),
                'updated_at' => Carbon::now()->subDays(2),
            ],
            [
                'product_code' => 'EC-HOSTING',
                'name_product' => 'E-commerce Hosting',
                'domain_included' => true,
                'ssh_access' => true,
                'email_feature' => true,
                'database_feature' => true,
                'ssl_included' => true,
                'storage' => 30, // 30 GB
                'price_monthly' => 180000.00,
                'description' => 'Paket hosting khusus untuk toko online dengan fitur keamanan tinggi dan performa optimal.',
                'status' => true,
                'created_at' => Carbon::now()->subDays(10),
                'updated_at' => Carbon::now()->subDay(),
            ]
        ];

        foreach ($products as $product) {
            Products::create($product);
        }

        $this->command->info('Product seeder berhasil dijalankan! 8 produk hosting telah dibuat.');
    }
}
