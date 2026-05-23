<?php

namespace Database\Factories;

use App\Models\Tenant;
use App\Models\Unit;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Unit>
 */
class UnitFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->company(),
            'is_active' => 1,
            'tenant_id' => Tenant::factory(),
            // Gera um número sequencial alto ou aleatório para evitar colisões de unique por tenant nos testes
            'friendly_id' => $this->faker->unique()->numberBetween(1, 99999),
        ];
    }
}
