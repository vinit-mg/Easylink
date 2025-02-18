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
        Schema::create('stores', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('CompanyId')->index();
            $table->string('name');               // Integration name (e.g., Shopify to Ackro)
            $table->string('platform');           // Shopify, WooCommerce, Traede, Economic
            $table->string('target');             // Ackro, Navison, Trimit, etc.
            $table->string('api_url');            // Base API URL
            $table->string('auth_type');          // basic, bearer, api_key, NTLM, etc.
            $table->string('username')->nullable();
            $table->string('password')->nullable();
            $table->string('token')->nullable();
            $table->string('api_key')->nullable();
            $table->string('client_id')->nullable();
            $table->string('client_secret')->nullable();
            $table->string('additional_info')->nullable(); // JSON for extra data
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stores');
    }
};
