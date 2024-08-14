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
            $table->id();
            $table->uuid('uuid')->nullable(false)->unique();
            $table->foreignId('company_id')->nullable()->constrained('companies')->onDelete('set null');
            $table->string('name')->nullable(false);
            $table->string('email')->unique()->nullable(false);
            $table->timestamp('email_verified_at')->nullable();
            $table->string('document_number')->nullable(false)->unique();
            $table->string('password')->nullable(false);
            $table->string('phone', 15)->nullable(false);
            $table->string('address', 100)->nullable(false);
            $table->string('qualification', 100)->nullable();
            $table->string('specialty', 100)->nullable();
            $table->string('license_number', 100)->nullable();
            $table->string('years_experience', 100)->nullable();
            $table->boolean('status')->default(false);
            $table->boolean('bool_doctor')->default(false);
            $table->rememberToken();
            $table->foreignId('current_team_id')->nullable();
            $table->string('profile_photo_path', 2048)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
