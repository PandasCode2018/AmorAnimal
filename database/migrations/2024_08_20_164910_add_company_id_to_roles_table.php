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
        Schema::table('roles', function (Blueprint $table) {
            $table->dropUnique('roles_name_guard_name_unique');
            $table->foreignId('company_id')->nullable()->constrained('companies')->onDelete('set null');
            $table->unique(['name', 'company_id', 'guard_name'], 'unique_company_name_guard');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('roles', function (Blueprint $table) {
            $table->dropUnique('unique_company_name_guard');
            $table->unique(['name', 'guard_name'], 'roles_name_guard_name_unique');
        });
    }
};
