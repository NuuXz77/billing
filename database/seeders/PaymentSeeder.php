<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Payments;
use Carbon\Carbon;

class PaymentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $payments = [
            [
                'payment_code' => 'BCA_TRANSFER',
                'payment_method' => 'Bank Transfer',
                'payment_bank' => 'Bank BCA',
                'payment_account_name' => 'PT. Hosting Indonesia',
                'payment_account_number' => '1234567890',
                'status' => 'active',
                'created_at' => Carbon::now()->subDays(30),
                'updated_at' => Carbon::now()->subDays(30),
            ],
            [
                'payment_code' => 'MANDIRI_TRANSFER',
                'payment_method' => 'Bank Transfer',
                'payment_bank' => 'Bank Mandiri',
                'payment_account_name' => 'PT. Hosting Indonesia',
                'payment_account_number' => '0987654321',
                'status' => 'active',
                'created_at' => Carbon::now()->subDays(30),
                'updated_at' => Carbon::now()->subDays(25),
            ],
            [
                'payment_code' => 'BRI_TRANSFER',
                'payment_method' => 'Bank Transfer',
                'payment_bank' => 'Bank BRI',
                'payment_account_name' => 'PT. Hosting Indonesia',
                'payment_account_number' => '5555666677',
                'status' => 'active',
                'created_at' => Carbon::now()->subDays(30),
                'updated_at' => Carbon::now()->subDays(20),
            ],
            [
                'payment_code' => 'BNI_TRANSFER',
                'payment_method' => 'Bank Transfer',
                'payment_bank' => 'Bank BNI',
                'payment_account_name' => 'PT. Hosting Indonesia',
                'payment_account_number' => '4444555566',
                'status' => 'active',
                'created_at' => Carbon::now()->subDays(30),
                'updated_at' => Carbon::now()->subDays(18),
            ],
            [
                'payment_code' => 'DANA_WALLET',
                'payment_method' => 'E-Wallet',
                'payment_bank' => 'DANA',
                'payment_account_name' => 'Hosting Indonesia',
                'payment_account_number' => '081234567890',
                'status' => 'active',
                'created_at' => Carbon::now()->subDays(25),
                'updated_at' => Carbon::now()->subDays(15),
            ],
            [
                'payment_code' => 'OVO_WALLET',
                'payment_method' => 'E-Wallet',
                'payment_bank' => 'OVO',
                'payment_account_name' => 'Hosting Indonesia',
                'payment_account_number' => '081987654321',
                'status' => 'active',
                'created_at' => Carbon::now()->subDays(25),
                'updated_at' => Carbon::now()->subDays(10),
            ],
            [
                'payment_code' => 'GOPAY_WALLET',
                'payment_method' => 'E-Wallet',
                'payment_bank' => 'GoPay',
                'payment_account_name' => 'Hosting Indonesia',
                'payment_account_number' => '081555666777',
                'status' => 'active',
                'created_at' => Carbon::now()->subDays(20),
                'updated_at' => Carbon::now()->subDays(5),
            ],
            [
                'payment_code' => 'BCA_VA',
                'payment_method' => 'Virtual Account',
                'payment_bank' => 'BCA Virtual Account',
                'payment_account_name' => 'PT. Hosting Indonesia',
                'payment_account_number' => '70012',
                'status' => 'active',
                'created_at' => Carbon::now()->subDays(20),
                'updated_at' => Carbon::now()->subDays(3),
            ],
            [
                'payment_code' => 'BNI_VA',
                'payment_method' => 'Virtual Account',
                'payment_bank' => 'BNI Virtual Account',
                'payment_account_name' => 'PT. Hosting Indonesia',
                'payment_account_number' => '88810',
                'status' => 'active',
                'created_at' => Carbon::now()->subDays(15),
                'updated_at' => Carbon::now()->subDays(2),
            ],
            [
                'payment_code' => 'CREDIT_CARD',
                'payment_method' => 'Credit Card',
                'payment_bank' => 'Visa/Mastercard Gateway',
                'payment_account_name' => 'Payment Gateway',
                'payment_account_number' => 'AUTO_GENERATED',
                'status' => 'active',
                'created_at' => Carbon::now()->subDays(10),
                'updated_at' => Carbon::now()->subDay(),
            ]
        ];

        foreach ($payments as $payment) {
            Payments::create($payment);
        }

        $this->command->info('Payment seeder berhasil dijalankan! 10 metode pembayaran telah dibuat.');
    }
}
