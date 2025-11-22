<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Transaction;
use App\Models\User;
use App\Models\Products;
use App\Models\Payments;
use Carbon\Carbon;

class TransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ambil data users, products, dan payments yang ada
        $users = User::all();
        $products = Products::all();
        $payments = Payments::all();

        if ($users->isEmpty() || $products->isEmpty() || $payments->isEmpty()) {
            $this->command->error('Pastikan data Users, Products, dan Payments sudah ada sebelum menjalankan TransactionSeeder');
            return;
        }

        // Data dummy transactions dengan berbagai status
        $transactions = [
            // Status: pending_payment
            [
                'transaction_code' => 'TRX-001',
                'user_id' => $users->random()->id,
                'product_id' => $products->random()->id,
                'payment_id' => $payments->random()->id,
                'status' => 'pending_payment',
                'start_date' => null,
                'end_date' => null,
                'total_payment' => 75000.00,
                'subdomain_web' => null,
                'subdomain_server' => null,
                'billing_cycle' => 'monthly',
                'payment_proof' => null,
                'admin_notes' => null,
                'confirmed_at' => null,
                'created_at' => Carbon::now()->subDays(5),
            ],
            [
                'transaction_code' => 'TRX-002',
                'user_id' => $users->random()->id,
                'product_id' => $products->random()->id,
                'payment_id' => $payments->random()->id,
                'status' => 'pending_payment',
                'start_date' => null,
                'end_date' => null,
                'total_payment' => 150000.00,
                'subdomain_web' => null,
                'subdomain_server' => null,
                'billing_cycle' => 'yearly',
                'payment_proof' => null,
                'admin_notes' => null,
                'confirmed_at' => null,
                'created_at' => Carbon::now()->subDays(3),
            ],

            // Status: pending_confirm
            [
                'transaction_code' => 'TRX-003',
                'user_id' => $users->random()->id,
                'product_id' => $products->random()->id,
                'payment_id' => $payments->random()->id,
                'status' => 'pending_confirm',
                'start_date' => null,
                'end_date' => null,
                'total_payment' => 95000.00,
                'subdomain_web' => null,
                'subdomain_server' => null,
                'billing_cycle' => 'monthly',
                'payment_proof' => 'payment_proof_001.jpg',
                'admin_notes' => null,
                'confirmed_at' => null,
                'created_at' => Carbon::now()->subDays(2),
            ],
            [
                'transaction_code' => 'TRX-004',
                'user_id' => $users->random()->id,
                'product_id' => $products->random()->id,
                'payment_id' => $payments->random()->id,
                'status' => 'pending_confirm',
                'start_date' => null,
                'end_date' => null,
                'total_payment' => 125000.00,
                'subdomain_web' => null,
                'subdomain_server' => null,
                'billing_cycle' => 'monthly',
                'payment_proof' => 'payment_proof_002.jpg',
                'admin_notes' => null,
                'confirmed_at' => null,
                'created_at' => Carbon::now()->subDays(1),
            ],
            [
                'transaction_code' => 'TRX-005',
                'user_id' => $users->random()->id,
                'product_id' => $products->random()->id,
                'payment_id' => $payments->random()->id,
                'status' => 'pending_confirm',
                'start_date' => null,
                'end_date' => null,
                'total_payment' => 200000.00,
                'subdomain_web' => null,
                'subdomain_server' => null,
                'billing_cycle' => 'yearly',
                'payment_proof' => 'payment_proof_003.jpg',
                'admin_notes' => null,
                'confirmed_at' => null,
                'created_at' => Carbon::now()->subHours(12),
            ],

            // Status: active
            [
                'transaction_code' => 'TRX-006',
                'user_id' => $users->random()->id,
                'product_id' => $products->random()->id,
                'payment_id' => $payments->random()->id,
                'status' => 'active',
                'start_date' => Carbon::now()->subDays(10),
                'end_date' => Carbon::now()->addDays(20),
                'total_payment' => 85000.00,
                'subdomain_web' => 'client1.myhosting.com',
                'subdomain_server' => 'server01.datacenter.com',
                'billing_cycle' => 'monthly',
                'payment_proof' => 'payment_proof_004.jpg',
                'admin_notes' => 'Transaksi telah dikonfirmasi dan layanan aktif',
                'confirmed_at' => Carbon::now()->subDays(8),
                'created_at' => Carbon::now()->subDays(12),
            ],
            [
                'transaction_code' => 'TRX-007',
                'user_id' => $users->random()->id,
                'product_id' => $products->random()->id,
                'payment_id' => $payments->random()->id,
                'status' => 'active',
                'start_date' => Carbon::now()->subDays(15),
                'end_date' => Carbon::now()->addDays(350),
                'total_payment' => 180000.00,
                'subdomain_web' => 'client2.myhosting.com',
                'subdomain_server' => 'server02.datacenter.com',
                'billing_cycle' => 'yearly',
                'payment_proof' => 'payment_proof_005.jpg',
                'admin_notes' => 'Paket premium aktif untuk 1 tahun',
                'confirmed_at' => Carbon::now()->subDays(14),
                'created_at' => Carbon::now()->subDays(16),
            ],
            [
                'transaction_code' => 'TRX-008',
                'user_id' => $users->random()->id,
                'product_id' => $products->random()->id,
                'payment_id' => $payments->random()->id,
                'status' => 'active',
                'start_date' => Carbon::now()->subDays(5),
                'end_date' => Carbon::now()->addDays(25),
                'total_payment' => 110000.00,
                'subdomain_web' => 'client3.myhosting.com',
                'subdomain_server' => 'server03.datacenter.com',
                'billing_cycle' => 'monthly',
                'payment_proof' => 'payment_proof_006.jpg',
                'admin_notes' => 'Setup hosting berhasil dilakukan',
                'confirmed_at' => Carbon::now()->subDays(4),
                'created_at' => Carbon::now()->subDays(6),
            ],

            // Status: rejected
            [
                'transaction_code' => 'TRX-009',
                'user_id' => $users->random()->id,
                'product_id' => $products->random()->id,
                'payment_id' => $payments->random()->id,
                'status' => 'rejected',
                'start_date' => null,
                'end_date' => null,
                'total_payment' => 65000.00,
                'subdomain_web' => null,
                'subdomain_server' => null,
                'billing_cycle' => 'monthly',
                'payment_proof' => 'payment_proof_007.jpg',
                'admin_notes' => 'Bukti pembayaran tidak valid atau tidak dapat diverifikasi',
                'confirmed_at' => null,
                'created_at' => Carbon::now()->subDays(7),
            ],
            [
                'transaction_code' => 'TRX-010',
                'user_id' => $users->random()->id,
                'product_id' => $products->random()->id,
                'payment_id' => $payments->random()->id,
                'status' => 'rejected',
                'start_date' => null,
                'end_date' => null,
                'total_payment' => 90000.00,
                'subdomain_web' => null,
                'subdomain_server' => null,
                'billing_cycle' => 'monthly',
                'payment_proof' => 'payment_proof_008.jpg',
                'admin_notes' => 'Nominal pembayaran tidak sesuai dengan harga produk',
                'confirmed_at' => null,
                'created_at' => Carbon::now()->subDays(4),
            ],

            // Status: expired
            [
                'transaction_code' => 'TRX-011',
                'user_id' => $users->random()->id,
                'product_id' => $products->random()->id,
                'payment_id' => $payments->random()->id,
                'status' => 'expired',
                'start_date' => Carbon::now()->subDays(45),
                'end_date' => Carbon::now()->subDays(15),
                'total_payment' => 75000.00,
                'subdomain_web' => 'expired1.myhosting.com',
                'subdomain_server' => 'server04.datacenter.com',
                'billing_cycle' => 'monthly',
                'payment_proof' => 'payment_proof_009.jpg',
                'admin_notes' => 'Layanan telah berakhir dan tidak diperpanjang',
                'confirmed_at' => Carbon::now()->subDays(44),
                'created_at' => Carbon::now()->subDays(46),
            ],

            // Status: canceled
            [
                'transaction_code' => 'TRX-012',
                'user_id' => $users->random()->id,
                'product_id' => $products->random()->id,
                'payment_id' => $payments->random()->id,
                'status' => 'canceled',
                'start_date' => null,
                'end_date' => null,
                'total_payment' => 120000.00,
                'subdomain_web' => null,
                'subdomain_server' => null,
                'billing_cycle' => 'yearly',
                'payment_proof' => null,
                'admin_notes' => 'Transaksi dibatalkan oleh pelanggan',
                'confirmed_at' => null,
                'created_at' => Carbon::now()->subDays(8),
            ],

            // Status: refunded
            [
                'transaction_code' => 'TRX-013',
                'user_id' => $users->random()->id,
                'product_id' => $products->random()->id,
                'payment_id' => $payments->random()->id,
                'status' => 'refunded',
                'start_date' => Carbon::now()->subDays(20),
                'end_date' => Carbon::now()->subDays(18),
                'total_payment' => 100000.00,
                'subdomain_web' => 'refund1.myhosting.com',
                'subdomain_server' => 'server05.datacenter.com',
                'billing_cycle' => 'monthly',
                'payment_proof' => 'payment_proof_010.jpg',
                'admin_notes' => 'Pembayaran dikembalikan karena masalah teknis yang tidak dapat diselesaikan',
                'confirmed_at' => Carbon::now()->subDays(19),
                'created_at' => Carbon::now()->subDays(21),
            ],

            // Additional transactions untuk testing
            [
                'transaction_code' => 'TRX-014',
                'user_id' => $users->random()->id,
                'product_id' => $products->random()->id,
                'payment_id' => $payments->random()->id,
                'status' => 'pending_confirm',
                'start_date' => null,
                'end_date' => null,
                'total_payment' => 155000.00,
                'subdomain_web' => null,
                'subdomain_server' => null,
                'billing_cycle' => 'yearly',
                'payment_proof' => 'payment_proof_011.jpg',
                'admin_notes' => null,
                'confirmed_at' => null,
                'created_at' => Carbon::now()->subHours(6),
            ],
            [
                'transaction_code' => 'TRX-015',
                'user_id' => $users->random()->id,
                'product_id' => $products->random()->id,
                'payment_id' => $payments->random()->id,
                'status' => 'active',
                'start_date' => Carbon::now()->subDays(2),
                'end_date' => Carbon::now()->addDays(28),
                'total_payment' => 95000.00,
                'subdomain_web' => 'client4.myhosting.com',
                'subdomain_server' => 'server06.datacenter.com',
                'billing_cycle' => 'monthly',
                'payment_proof' => 'payment_proof_012.jpg',
                'admin_notes' => 'Transaksi terbaru berhasil diaktifkan',
                'confirmed_at' => Carbon::now()->subDays(1),
                'created_at' => Carbon::now()->subDays(3),
            ],
        ];

        // Insert semua data
        foreach ($transactions as $transaction) {
            Transaction::create($transaction);
        }

        $this->command->info('Transaction seeder berhasil dijalankan! 15 transaksi dummy telah dibuat dengan berbagai status.');
    }
}
