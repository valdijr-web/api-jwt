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
        Schema::create('tenants', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('plan')->default('free'); // Exemplo de campo para o plano do tenant
            //crie um campo para status do tenant
            $table->string('status')->nullable()->default('active'); // Exemplo de campo para o status do tenant
            //crie um campo para o documento do tenant
            $table->string('document')->nullable(); // Exemplo de campo para o documento do tenant
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tenants');
    }
};
