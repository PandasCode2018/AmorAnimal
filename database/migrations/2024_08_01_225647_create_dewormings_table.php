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
        Schema::create('dewormings', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique()->nullable(false);
            $table->foreignId('company_id')->nullable()->constrained('companies')->onDelete('set null');
            $table->foreignId('consultation_id')->nullable()->constrained('consultations')->onDelete('set null');
            $table->boolean('internal_or_external')->nullable();
            $table->string('medicine', 200)->nullable();
            $table->date('deworming_date')->nullable();
            $table->date('next_deworming_date')->nullable();
            $table->longText('note')->nullable();
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('set null');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dewormings');
    }
};
