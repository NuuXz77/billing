<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('product_code')->unique();
            $table->string('name_product');
            $table->boolean('domain_included')->default(false);
            $table->boolean('ssh_access')->default(false);
            $table->boolean('email_feature')->default(false);
            $table->boolean('database_feature')->default(false);
            $table->boolean('ssl_included')->default(false);
            $table->unsignedInteger('storage'); // dalam GB atau MB
            $table->string('bandwidth')->nullable(); // Bandwidth (contoh: "50 GB", "Unlimited")
            $table->decimal('price_monthly', 10, 2);
            $table->decimal('price_original', 10, 2)->nullable(); // Harga asli sebelum diskon
            $table->integer('discount_percentage')->default(0); // Persentase diskon (0-100)
            $table->integer('free_months')->default(0); // Bulan gratis (contoh: +2 bulan gratis)
            $table->text('description')->nullable();
            $table->text('sub_description')->nullable(); // Sub description
            $table->text('features')->nullable(); // Features dalam format JSON atau text
            $table->boolean('status')->default(true); // true = public, false = draft
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
