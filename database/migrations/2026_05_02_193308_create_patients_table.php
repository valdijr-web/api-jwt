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
        Schema::create('patients', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tenant_id')->constrained();

            $table->string('name'); //nome completo do paciente
            $table->date('birth_date')->nullable(); //data de nascimento
            $table->string('gender')->nullable(); //sexo (Masculino, Feminino, Outro)
            $table->string('cpf')->nullable();
            $table->string('rg')->nullable();

            $table->string('email')->nullable();
            $table->string('phone_number')->nullable();//telefone
            $table->string('emergency_contact')->nullable();//telefone de emergência

            $table->string('zip_code')->nullable(); //CEP
            $table->string('street')->nullable(); //endereço
            $table->string('address_number')->nullable(); //número
            $table->string('complement')->nullable(); //complemento
            $table->string('neighborhood')->nullable(); //bairro
            $table->string('city')->nullable(); //cidade
            $table->string('state')->nullable(); //estado
            $table->string('country')->nullable(); //país

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patients');
    }
};
