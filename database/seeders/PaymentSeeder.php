<?php

namespace Database\Seeders;

use App\Models\Payment;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PaymentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $payments = [
            // Bank Transfer - BRI
            [
                'payment_code' => 'PAY-BRI-001',
                'payment_method' => 'Bank Transfer',
                'payment_bank' => 'BRI',
                'payment_account_name' => 'PT Hoci Indonesia',
                'payment_account_number' => '0015-01-000123-30-5',
                'status' => 'active',
            ],
            // Bank Transfer - BNI
            [
                'payment_code' => 'PAY-BNI-001',
                'payment_method' => 'Bank Transfer',
                'payment_bank' => 'BNI',
                'payment_account_name' => 'PT Hoci Indonesia',
                'payment_account_number' => '0123456789',
                'status' => 'active',
            ],
            // Bank Transfer - BCA
            [
                'payment_code' => 'PAY-BCA-001',
                'payment_method' => 'Bank Transfer',
                'payment_bank' => 'BCA',
                'payment_account_name' => 'PT Hoci Indonesia',
                'payment_account_number' => '8880123456',
                'status' => 'active',
            ],
            // Bank Transfer - Mandiri
            [
                'payment_code' => 'PAY-MANDIRI-001',
                'payment_method' => 'Bank Transfer',
                'payment_bank' => 'Mandiri',
                'payment_account_name' => 'PT Hoci Indonesia',
                'payment_account_number' => '1370012345678',
                'status' => 'active',
            ],
            // E-Wallet - OVO
            [
                'payment_code' => 'PAY-OVO-001',
                'payment_method' => 'E-Wallet',
                'payment_bank' => 'OVO',
                'payment_account_name' => 'PT Hoci Indonesia',
                'payment_account_number' => '081234567890',
                'status' => 'active',
            ],
            // E-Wallet - GoPay
            [
                'payment_code' => 'PAY-GOPAY-001',
                'payment_method' => 'E-Wallet',
                'payment_bank' => 'GoPay',
                'payment_account_name' => 'PT Hoci Indonesia',
                'payment_account_number' => '081234567891',
                'status' => 'active',
            ],
            // E-Wallet - Dana
            [
                'payment_code' => 'PAY-DANA-001',
                'payment_method' => 'E-Wallet',
                'payment_bank' => 'Dana',
                'payment_account_name' => 'PT Hoci Indonesia',
                'payment_account_number' => '081234567892',
                'status' => 'active',
            ],
            // E-Wallet - ShopeePay
            [
                'payment_code' => 'PAY-SHOPEEPAY-001',
                'payment_method' => 'E-Wallet',
                'payment_bank' => 'ShopeePay',
                'payment_account_name' => 'PT Hoci Indonesia',
                'payment_account_number' => '081234567893',
                'status' => 'active',
            ],
            // Retail - Alfamart
            [
                'payment_code' => 'PAY-ALFAMART-001',
                'payment_method' => 'Retail',
                'payment_bank' => 'Alfamart',
                'payment_account_name' => 'PT Hoci Indonesia',
                'payment_account_number' => 'HOCI-ALFA-001',
                'status' => 'active',
            ],
            // Retail - Indomaret
            [
                'payment_code' => 'PAY-INDOMARET-001',
                'payment_method' => 'Retail',
                'payment_bank' => 'Indomaret',
                'payment_account_name' => 'PT Hoci Indonesia',
                'payment_account_number' => 'HOCI-INDO-001',
                'status' => 'active',
            ],
            // QRIS
            [
                'payment_code' => 'PAY-QRIS-001',
                'payment_method' => 'QRIS',
                'payment_bank' => 'QRIS',
                'payment_account_name' => 'PT Hoci Indonesia',
                'payment_account_number' => 'ID1234567890123456',
                'status' => 'active',
            ],
        ];

        foreach ($payments as $payment) {
            Payment::create($payment);
        }
    }
}
