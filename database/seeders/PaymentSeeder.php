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
            [
                'payment_code' => 'PAY-BRI-001',
                'payment_method' => 'Bank Transfer',
                'payment_bank' => 'BRI',
                'payment_account_name' => 'PT Hoci Indonesia',
                'payment_account_number' => '5556667778',
                'status' => 'active',
            ],
        ];

        foreach ($payments as $payment) {
            Payment::create($payment);
        }
    }
}
