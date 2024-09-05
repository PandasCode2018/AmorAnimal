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
        Schema::create('treatments', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique()->nullable(false);
            $table->foreignId('company_id')->nullable()->constrained('companies')->onDelete('set null');
            $table->foreignId('consultation_id')->nullable()->constrained('consultations')->onDelete('set null');
            $table->string('drug_name', 100)->nullable();
            $table->string('medicine_presentation', 50)->nullable(true);
            $table->date('application_date')->nullable();
            $table->date('reinforcement_date')->nullable();
            $table->string('dose', 50)->nullable();
            $table->string('frequency', 200)->nullable();
            $table->boolean('internal_or_external')->nullable();
            $table->boolean('aplicado')->default(0);
            $table->longText('note')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('treatments');
    }
};
