<?php

namespace Database\Seeders;

use App\Models\Transaction;
use App\Models\User;
use App\Models\Product;
use App\Models\Payment;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class TransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ambil semua user dengan role 'member' (MBR)
        $users = User::where('role', 'member')->get();
        
        if ($users->count() === 0) {
            echo "Error: Tidak ada user dengan role member di database!\n";
            return;
        }

        $products = Product::all();
        $payments = Payment::all();

        // Status options sesuai migration
        $statuses = ['active', 'pending_payment', 'pending_confirm', 'expired', 'canceled'];
        $billingCycles = ['monthly', 'yearly', 'custom'];
        $transactionTypes = ['payment', 'renewal', 'purchase', 'topup'];

        // Buat transaksi untuk setiap user
        foreach ($users as $user) {
            // Buat 10 transaksi per user
            for ($i = 1; $i <= 10; $i++) {
                $product = $products->random();
                $payment = $payments->random();
                $status = $statuses[array_rand($statuses)];
                $billingCycle = $billingCycles[array_rand($billingCycles)];
                $transactionType = $transactionTypes[array_rand($transactionTypes)];
                
                // Generate tanggal transaksi (random 90 hari terakhir)
                $createdAt = Carbon::now()->subDays(rand(1, 90));
                $startDate = $createdAt->copy();
                
                // Tentukan durasi berdasarkan billing cycle
                $durationMonths = $billingCycle === 'monthly' ? 1 : ($billingCycle === 'yearly' ? 12 : rand(3, 6));
                $endDate = $startDate->copy()->addMonths($durationMonths);
                
                // Hitung total payment
                $totalPayment = $product->price_monthly * $durationMonths;
                
                // Generate subdomain (jika ada)
                $subdomain = strtolower(str_replace(' ', '-', $product->name_product)) . '-user' . $user->id . '-' . $i;
                
                // Description sesuai jenis transaksi
                $description = "{$product->name_product} - {$durationMonths} bulan";
                
                // Transaction code menggunakan user_transaction_number (dimulai dari 1 untuk setiap user)
                $transactionDate = $createdAt->format('d-m-Y');
                $transactionCode = "TRX-{$i}-{$transactionDate}";
                
                // Buat transaksi
                $transaction = Transaction::create([
                    'transaction_code' => $transactionCode,
                    'transaction_type' => $transactionType,
                    'description' => $description,
                    'user_id' => $user->id,
                    'user_transaction_number' => $i,
                    'product_id' => $product->id,
                    'payment_id' => $payment->id,
                    'status' => $status,
                    'start_date' => $startDate,
                    'end_date' => $endDate,
                    'total_payment' => $totalPayment,
                    'payment_method' => $payment->payment_bank,
                    'subdomain_web' => $subdomain . '.hoci.id',
                    'subdomain_server' => 'server-' . $subdomain . '.hoci.id',
                    'billing_cycle' => $billingCycle,
                    'payment_proof' => $status === 'pending_confirm' ? 'payment_proof_' . $i . '.jpg' : null,
                    'admin_notes' => $status === 'canceled' ? 'Dibatalkan oleh user' : null,
                    'confirmed_at' => in_array($status, ['active']) ? $createdAt->addHours(rand(1, 24)) : null,
                    'created_at' => $createdAt,
                    'updated_at' => $createdAt,
                ]);
            }
        }

        echo "Berhasil membuat " . ($users->count() * 10) . " transaksi untuk {$users->count()} user!\n";
    }
}
