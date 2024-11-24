<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Room>
 */
class RoomFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        //Nagyon csúnya megoldás, nem találtam szebbet.
         $name = $this->faker->words(1, true);
         while(strlen($name) <= 5) {
             $name = $this->faker->words(1, true);
         }

        return [
            'name' => $name,
            'description' => fake()->words(rand(10,20), true),
            'image'=>rand(1,10) .'.png'
        ];
    }
}
