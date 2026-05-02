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
            // Business Identification
            $table->string('trade_name'); //Nome fantasia
            $table->string('company_name')->nullable(); // Razão Social

            // Legal Identification
            $table->string('document')->unique()->nullable(); // CPF ou CNPJ
            $table->enum('document_type', ['cpf', 'cnpj'])->default('cnpj');

            //contato
            $table->string('whatsapp_number')->nullable();

            $table->string('plan')->default('free'); // Exemplo de campo para o plano do tenant

            $table->boolean('is_active')->default(true);
            $table->timestamps();
            $table->softDeletes();
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
