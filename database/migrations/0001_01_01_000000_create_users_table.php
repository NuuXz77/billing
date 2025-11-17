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
        Schema::create('users', function (Blueprint $table) {
            $table->id('id');
            $table->string('user_code')->unique();
            $table->string('master_user')->nullable();
            $table->enum('role', ['admin', 'member'])->default('member');
            $table->string('email')->unique();
            $table->string('full_name');
            $table->string('username')->unique(); //digunakan untuk subdomain nantinya
            $table->string('password');
            $table->enum('status', ['active', 'suspended', 'deleted'])->default('active');
            $table->string('foto_profile')->nullable(); //
            $table->string('phone')->nullable();
            $table->text('address')->nullable(); // alamat lengkap
            $table->string('district')->nullable(); // kecamatan
            $table->string('city')->nullable(); // kota
            $table->string('province')->nullable(); // provinsi
            $table->string('pos_code')->nullable(); // kode pos
            $table->string('country')->nullable(); // negara
            $table->string('company_name')->nullable(); // nama perusahaan
            $table->timestamp('last_active')->nullable(); // terakhir aktif
            $table->timestamps();
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
