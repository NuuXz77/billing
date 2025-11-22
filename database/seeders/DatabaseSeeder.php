<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $this->call([
            UserSeeder::class,          // Buat admin & member dummy
            PaymentSeeder::class,       // Buat payment methods
            ProductSeeder::class,       // Buat products
            TransactionSeeder::class,   // Buat transactions (dengan auto-numbering)
        ]);
        
        $this->command->info('✅ Database seeding completed!');
        $this->command->info('📊 Summary:');
        $this->command->info('   - Users: Admin & Members created');
        $this->command->info('   - Payments: Payment methods created');
        $this->command->info('   - Products: Products created');
        $this->command->info('   - Transactions: Auto-numbered transactions created');
    }
}
