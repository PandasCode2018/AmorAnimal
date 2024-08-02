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
        Schema::create('responsibles', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique()->nullable(false);
            $table->foreignId('company_id')->nullable()->constrained('companies')->onDelete('set null');
            $table->string('name', 100)->nullable(false);
            $table->string('email', 50)->nullable(false)->unique();
            $table->string('phone', 15)->nullable();
            $table->string('address', 100)->nullable();
            $table->string('document_number', 15)->nullable(false)->unique();
            $table->string('password')->nullable(false);
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
        Schema::dropIfExists('responsibles');
    }
};
