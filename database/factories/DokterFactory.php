<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Dokter>
 */
class DokterFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $user = User::factory()->dokter()->create();

        return [
            'nama' => $user->name,
            'email' => $user->email,
            'nomor_telepon' => $this->faker->phoneNumber(),
            'keahlian' => $this->faker->randomElement(['Umum', 'Jantung', 'Kulit', 'Mata', 'THT']),
            'user_id' => $user->id,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
