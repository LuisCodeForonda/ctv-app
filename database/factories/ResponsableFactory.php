<?php

namespace Database\Factories;

use App\Models\Responsable;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Responsable>
 */
class ResponsableFactory extends Factory
{
    protected $model = Responsable::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nombre' => $this->faker->name(),
            'cargo' => $this->faker->lastName(),
            'carnet' => $this->faker->numberBetween(1000000, 10000000),
            'celular' => $this->faker->numberBetween(1000000, 9999999)
        ];
    }
}
