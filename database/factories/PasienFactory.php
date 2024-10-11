<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Pasien>
 */
class PasienFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $user = User::factory()->pasien()->create();

        return [
            'nama' => $user->name,
            'email' => $user->email,
            'nomor_telepon' => $this->faker->phoneNumber(),
            'alamat' => $this->faker->address(),
            'golongan_darah' => $this->faker->randomElement(['A', 'B', 'AB', 'O']),
            'tanggal_lahir' => $this->faker->date(),
            'jenis_kelamin' => $this->faker->randomElement(['Laki-laki', 'Perempuan']),
            'user_id' => $user->id,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
