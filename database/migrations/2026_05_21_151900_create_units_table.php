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
        Schema::create('units', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('friendly_id'); //ID interno para cada tenant
            $table->foreignId('tenant_id')->constrained();
            $table->string('name');

            $table->string('phone')->nullable();
            $table->string('email')->nullable();

            $table->string('zip_code')->nullable(); //CEP
            $table->string('street')->nullable(); //endereço
            $table->string('address_number')->nullable(); //número
            $table->string('complement')->nullable(); //complemento
            $table->string('neighborhood')->nullable(); //bairro
            $table->string('city')->nullable(); //cidade
            $table->string('state')->nullable(); //estado
            $table->string('country')->nullable(); //país

            $table->boolean('is_active')->default(true);

            $table->timestamps();
            $table->softDeletes();

            $table->unique(['tenant_id', 'friendly_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('units');
    }
};
