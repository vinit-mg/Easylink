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
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->string('CompanyName', 200)->collation('utf8mb4_general_ci');
            $table->string('CompanyLogo', 500)->collation('utf8mb4_general_ci');
            $table->dateTime('StartDate');
            $table->dateTime('TerminationDate');
            $table->string('AccessURL', 500)->collation('utf8mb4_general_ci');
            $table->boolean('IsActive');
            $table->timestamp('deleted_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('companies');
    }
};
