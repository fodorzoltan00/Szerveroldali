<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserFactory extends Factory
{

    protected static ?string $password;


    public function definition(): array
    {
        $cardNumber = self::generateCardNumber();
        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('password'),
            'remember_token' => Str::random(10),
            'admin' => rand(0, 1),
            'phone_number' => fake()->phoneNumber(),
            'card_number' => $cardNumber
        ];
    }

    public static function generateCardNumber() {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $cardNumber = '';
        for ($i = 0; $i < 16; $i++) {
            $cardNumber .= $characters[rand(0, strlen($characters) - 1)];
        }

        if (preg_match('/^[0-9a-zA-Z]{16}$/', $cardNumber)) {
            return $cardNumber;
        }
    }


    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
