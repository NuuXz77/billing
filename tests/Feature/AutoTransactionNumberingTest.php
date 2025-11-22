<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Transaction;
use App\Models\Product;
use App\Models\Payment;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AutoTransactionNumberingTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test auto-generation untuk member baru (pertama kali transaksi)
     */
    public function test_first_transaction_starts_from_one()
    {
        // Setup: Buat member baru
        $user = User::factory()->create(['role' => 'member']);
        $product = Product::factory()->create();
        $payment = Payment::factory()->create();

        // Action: Buat transaksi pertama
        $transaction = Transaction::create([
            'user_id' => $user->id,
            'product_id' => $product->id,
            'payment_id' => $payment->id,
            'status' => 'pending_payment',
            'start_date' => now(),
            'end_date' => now()->addMonth(),
            'total_payment' => 100000,
        ]);

        // Assert: Harus dimulai dari 1
        $this->assertEquals(1, $transaction->user_transaction_number);
        $this->assertStringContainsString('TRX-1-', $transaction->transaction_code);
    }

    /**
     * Test auto-increment untuk transaksi kedua user yang sama
     */
    public function test_second_transaction_increments_correctly()
    {
        $user = User::factory()->create(['role' => 'member']);
        $product = Product::factory()->create();
        $payment = Payment::factory()->create();

        // Transaksi 1
        $transaction1 = Transaction::create([
            'user_id' => $user->id,
            'product_id' => $product->id,
            'payment_id' => $payment->id,
            'status' => 'pending_payment',
            'start_date' => now(),
            'end_date' => now()->addMonth(),
            'total_payment' => 100000,
        ]);

        // Transaksi 2
        $transaction2 = Transaction::create([
            'user_id' => $user->id,
            'product_id' => $product->id,
            'payment_id' => $payment->id,
            'status' => 'pending_payment',
            'start_date' => now(),
            'end_date' => now()->addMonth(),
            'total_payment' => 150000,
        ]);

        // Assert
        $this->assertEquals(1, $transaction1->user_transaction_number);
        $this->assertEquals(2, $transaction2->user_transaction_number);
    }

    /**
     * Test independent numbering untuk 2 user berbeda
     */
    public function test_different_users_have_independent_numbering()
    {
        // Setup: 2 member berbeda
        $user1 = User::factory()->create(['role' => 'member']);
        $user2 = User::factory()->create(['role' => 'member']);
        $product = Product::factory()->create();
        $payment = Payment::factory()->create();

        // User 1: Buat 3 transaksi
        $user1Trans1 = Transaction::create([
            'user_id' => $user1->id,
            'product_id' => $product->id,
            'payment_id' => $payment->id,
            'status' => 'active',
            'start_date' => now(),
            'end_date' => now()->addMonth(),
            'total_payment' => 100000,
        ]);

        $user1Trans2 = Transaction::create([
            'user_id' => $user1->id,
            'product_id' => $product->id,
            'payment_id' => $payment->id,
            'status' => 'active',
            'start_date' => now(),
            'end_date' => now()->addMonth(),
            'total_payment' => 100000,
        ]);

        $user1Trans3 = Transaction::create([
            'user_id' => $user1->id,
            'product_id' => $product->id,
            'payment_id' => $payment->id,
            'status' => 'active',
            'start_date' => now(),
            'end_date' => now()->addMonth(),
            'total_payment' => 100000,
        ]);

        // User 2: Buat 2 transaksi
        $user2Trans1 = Transaction::create([
            'user_id' => $user2->id,
            'product_id' => $product->id,
            'payment_id' => $payment->id,
            'status' => 'active',
            'start_date' => now(),
            'end_date' => now()->addMonth(),
            'total_payment' => 150000,
        ]);

        $user2Trans2 = Transaction::create([
            'user_id' => $user2->id,
            'product_id' => $product->id,
            'payment_id' => $payment->id,
            'status' => 'active',
            'start_date' => now(),
            'end_date' => now()->addMonth(),
            'total_payment' => 150000,
        ]);

        // Assert: User 1 counter independent dari User 2
        $this->assertEquals(1, $user1Trans1->user_transaction_number);
        $this->assertEquals(2, $user1Trans2->user_transaction_number);
        $this->assertEquals(3, $user1Trans3->user_transaction_number);

        $this->assertEquals(1, $user2Trans1->user_transaction_number); // Mulai dari 1 lagi!
        $this->assertEquals(2, $user2Trans2->user_transaction_number);
    }

    /**
     * Test transaction code auto-generation
     */
    public function test_transaction_code_generation()
    {
        $user = User::factory()->create(['role' => 'member']);
        $product = Product::factory()->create();
        $payment = Payment::factory()->create();

        $transaction = Transaction::create([
            'user_id' => $user->id,
            'product_id' => $product->id,
            'payment_id' => $payment->id,
            'status' => 'pending_payment',
            'start_date' => now(),
            'end_date' => now()->addMonth(),
            'total_payment' => 100000,
        ]);

        // Assert: Transaction code format
        $this->assertNotEmpty($transaction->transaction_code);
        $this->assertStringStartsWith('TRX-', $transaction->transaction_code);
        
        // Format: TRX-1-20-11-2025
        $parts = explode('-', $transaction->transaction_code);
        $this->assertEquals('TRX', $parts[0]);
        $this->assertEquals('1', $parts[1]); // user_transaction_number
        $this->assertIsNumeric($parts[2]); // day
    }

    /**
     * Test dengan 10 transaksi (simulasi seeder)
     */
    public function test_ten_transactions_numbering()
    {
        $user = User::factory()->create(['role' => 'member']);
        $product = Product::factory()->create();
        $payment = Payment::factory()->create();

        $transactions = [];
        
        // Buat 10 transaksi
        for ($i = 1; $i <= 10; $i++) {
            $transactions[] = Transaction::create([
                'user_id' => $user->id,
                'product_id' => $product->id,
                'payment_id' => $payment->id,
                'status' => 'active',
                'start_date' => now(),
                'end_date' => now()->addMonth(),
                'total_payment' => 100000 * $i,
            ]);
        }

        // Assert: Nomor 1-10 berurutan
        foreach ($transactions as $index => $transaction) {
            $expectedNumber = $index + 1;
            $this->assertEquals($expectedNumber, $transaction->user_transaction_number);
        }
    }

    /**
     * Test transaksi ke-11 setelah seeder (yang sudah ada 10 transaksi)
     */
    public function test_transaction_after_seeder_data()
    {
        $user = User::factory()->create(['role' => 'member']);
        $product = Product::factory()->create();
        $payment = Payment::factory()->create();

        // Simulasi seeder: buat 10 transaksi dengan user_transaction_number 1-10
        for ($i = 1; $i <= 10; $i++) {
            Transaction::create([
                'user_id' => $user->id,
                'user_transaction_number' => $i, // Manual set (dari seeder)
                'transaction_code' => "TRX-{$i}-01-01-2025",
                'product_id' => $product->id,
                'payment_id' => $payment->id,
                'status' => 'active',
                'start_date' => now(),
                'end_date' => now()->addMonth(),
                'total_payment' => 100000,
            ]);
        }

        // Transaksi baru (otomatis)
        $newTransaction = Transaction::create([
            'user_id' => $user->id,
            'product_id' => $product->id,
            'payment_id' => $payment->id,
            'status' => 'pending_payment',
            'start_date' => now(),
            'end_date' => now()->addMonth(),
            'total_payment' => 100000,
            // user_transaction_number TIDAK diisi manual
        ]);

        // Assert: Harus mulai dari 11 (melanjutkan dari seeder)
        $this->assertEquals(11, $newTransaction->user_transaction_number);
        $this->assertStringContainsString('TRX-11-', $newTransaction->transaction_code);
    }
}
