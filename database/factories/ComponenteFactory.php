<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Componente>
 */
class ComponenteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'descripcion' => $this->faker->paragraph,
            'observaciones' => $this->faker->paragraph,
            'modelo' => $this->faker->name,
            'serie' => $this->faker->phoneNumber,
            'cantidad' => $this->faker->randomElement([1,2,3]),
            'marca_id' => $this->faker->randomElement([1,2,3,4,5,6,7,8,9,10]),
        ];
    }
}
