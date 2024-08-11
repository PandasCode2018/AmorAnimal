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
        Schema::create('animals', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique()->nullable(false);
            $table->foreignId('company_id')->nullable()->constrained('companies')->onDelete('set null');
            $table->string('code_animal', 100)->nullable(false)->unique();
            $table->foreignId('responsible_id')->nullable()->constrained('responsibles')->onDelete('set null');
            $table->string('name', 100)->nullable(false);
            $table->string('color')->nullable();
            $table->foreignId('animal_species_id')->nullable()->constrained('animal_species')->onDelete('set null');
            $table->string('animal_race', 200)->nullable();
            $table->string('weight')->nullable();
            $table->string('sex', 50)->nullable();
            $table->string('age', 3)->nullable();
            $table->string('blood_type', 3)->nullable();
            $table->string('microchip_code', 100)->nullable();
            $table->string('photo', 245)->nullable();
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
        Schema::dropIfExists('animals');
    }
};
