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
        Schema::create('evidencesuggestions', function (Blueprint $table) {
            $table->id();
            $table->string('imgEvidence', 245)->nullable();
            $table->foreignId('suggestion_id')->nullable()->constrained('suggestions')->onDelete('set null');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('evidencesuggestions');
    }
};
