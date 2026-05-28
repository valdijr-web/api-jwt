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
            $table->unsignedBigInteger('friendly_id'); //ID interno para cada tenant

            $table->string('name'); //nome completo do paciente
            $table->date('birth_date')->nullable(); //data de nascimento
            $table->string('gender')->nullable(); //sexo (Masculino, Feminino, Outro)
            $table->string('cpf')->nullable();
            $table->string('rg')->nullable();

            $table->string('email')->nullable();
            $table->string('phone_number')->nullable();//telefone
            $table->string('emergency_contact')->nullable();//telefone de emergência

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
        Schema::dropIfExists('patients');
    }
};
