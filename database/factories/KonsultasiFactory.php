<?php

namespace Database\Factories;

use App\Models\Dokter;
use App\Models\Pasien;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Konsultasi>
 */
class KonsultasiFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'tanggal_keluhan' => $this->faker->dateTime(),
            'keluhan' => $this->faker->sentence(),
            'status' => $this->faker->randomElement(['pending', 'diterima', 'ditolak']),
            'dokter_id' => Dokter::factory(),
            'pasien_id' => Pasien::factory(),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
