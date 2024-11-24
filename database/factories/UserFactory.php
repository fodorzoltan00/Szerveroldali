<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\app\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
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

        // Ellenőrizzük, hogy a kártyaszám megfelel a regex szabályoknak
        if (preg_match('/^[0-9a-zA-Z]{16}$/', $cardNumber)) {
            return $cardNumber;
        }
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
