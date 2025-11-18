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
            $table->decimal('price_monthly', 10, 2);
            $table->text('description')->nullable();
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
