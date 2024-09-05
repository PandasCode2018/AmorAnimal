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
        Schema::create('traiges', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique()->nullable(false);
            $table->foreignId('company_id')->nullable()->constrained('companies')->onDelete('set null');
            $table->foreignId('consultation_id')->nullable()->constrained('consultations')->onDelete('set null');
            $table->string('condicion_corporal', 30)->nullable(true);
            $table->string('temperatura_corporal', 30)->nullable(true);
            $table->string('frecuencia_respiratoria', 30)->nullable(true);
            $table->string('relleno_capilar', 30)->nullable(true);
            $table->string('mucosa', 30)->nullable(true);
            $table->string('frecuencia_cardiaca', 30)->nullable(true);
            $table->string('llenado_capilar', 30)->nullable(true);
            $table->string('pulso', 20)->nullable(true);
            $table->integer('numero_pardos')->nullable(true);
            $table->integer('esterelizado')->nullable(true);
            $table->text('ultima_desparacitacion')->nullable(true);
            $table->text('cirugias_previas')->nullable(true);
            $table->text('esquema_vacunal')->nullable(true);
            $table->text('tratamiento_reciente')->nullable(true);
            $table->text('enfermedades_previas')->nullable(true);
            $table->text('dieta')->nullable(true);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('traiges');
    }
};
