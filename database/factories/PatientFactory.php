<?php

namespace Database\Factories;

use App\Models\Patient;
use App\Models\Tenant;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Patient>
 */
class PatientFactory extends Factory
{
    /**
     * O nome do model correspondente à factory.
     *
     * @var string
     */
    protected $model = Patient::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // Força o Faker a gerar dados no padrão brasileiro (CPF, Telefone, CEP, etc.)
        $fakerBr = \Faker\Factory::create('pt_BR');

        return [
            // Cria um Tenant dinamicamente se nenhum for passado no estado da Factory
            'tenant_id' => Tenant::factory(),

            'name' => $fakerBr->name(),
            'birth_date' => $this->faker->date('Y-m-d', '-18 years'), // Garante maioridade por padrão, ajuste se necessário
            'gender' => $this->faker->randomElement(['Masculino', 'Feminino', 'Outro']),
            'cpf' => $fakerBr->cpf(),
            'rg' => $fakerBr->rg(),

            'email' => $this->faker->unique()->safeEmail(),
            'phone_number' => $fakerBr->cellphone(),
            'emergency_contact' => $fakerBr->cellphone(),

            'zip_code' => $fakerBr->postcode(), // Gera formato XXXXX-XXX
            'street' => $fakerBr->streetName(),
            'address_number' => $this->faker->buildingNumber(),
            'complement' => $this->faker->optional(0.5)->secondaryAddress(), // 50% de chance de ter complemento
            'neighborhood' => $this->faker->word(),
            'city' => $fakerBr->city(),
            'state' => $fakerBr->stateAbbr(), // Iniciais do estado (ex: PE, SP, PB)
            'country' => 'Brasil',
        ];
    }
}
