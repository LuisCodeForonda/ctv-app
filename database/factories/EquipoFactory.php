<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Equipo>
 */
class EquipoFactory extends Factory
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
            'observaciones' => $this->faker->lastName,
            'modelo' => $this->faker->name,
            'serie' => $this->faker->phoneNumber,
            'serietec' => $this->faker->uuid,
            'estado' => $this->faker->randomElement([1,2,3,4]),
            'area' => $this->faker->name,
            'ubicacion' => $this->faker->name,
            'slug' => $this->faker->uuid,
            'responsable_id' => $this->faker->randomElement([1,2,3,4,5]),
            'marca_id' => $this->faker->randomElement([1, 2, 3, 4, 5, 6, 7, 8, 9, 10]),
        ];
    }
}
