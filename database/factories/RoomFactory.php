<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;


class RoomFactory extends Factory
{

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
            'image'=> fake()->imageUrl(80, 40, 'cats', true),
        ];
    }
}
