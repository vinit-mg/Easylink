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
        Schema::create('source', function (Blueprint $table) {
            $table->id();
            $table->string('SourceName', 200)->collation('utf8mb4_general_ci');
            $table->boolean('IsActive');
            $table->text('Remarks')->collation('utf8mb4_general_ci');
            $table->timestamp('deleted_at')->nullable();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('source');
    }
};
