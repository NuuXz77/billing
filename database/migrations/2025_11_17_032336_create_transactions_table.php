<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->string('transaction_code')->unique();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('product_id')->constrained('products')->onDelete('cascade');
            $table->foreignId('payment_id')->constrained('payments')->onDelete('cascade');
            $table->enum('status', ['active', 'pending_payment', 'pending_confirm', 'expired', 'canceled', 'refunded'])->default('active');
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->decimal('total_payment', 10, 2);
            $table->string('subdomain_web')->nullable();
            $table->string('subdomain_server')->nullable();
            $table->enum('billing_cycle', ['monthly', 'yearly', 'custum'])->default('monthly');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
