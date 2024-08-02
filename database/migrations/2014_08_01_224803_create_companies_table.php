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
            $table->uuid('uuid')->unique()->nullable(false);
            $table->string('name_company', 100)->nullable(false);
            $table->string('nit', 50)->nullable();
            $table->string('email', 50)->nullable(false)->unique();
            $table->string('address', 100)->nullable();
            $table->string('phone', 12)->nullable(false);
            $table->boolean('status')->default(true);
            $table->string('logo', 2048)->nullable();
            $table->date('end_license')->nullable(false);
            $table->timestamps();
            $table->softDeletes();
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
