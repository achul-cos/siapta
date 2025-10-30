<?php

namespace Database\Factories;

use App\Models\Mahasiswa;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Faker\Generator as Faker;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Mahasiswa>
 */
class MahasiswaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Mahasiswa::class;

    public function definition(): array
    {
        $faker = \Faker\Factory::create('id_ID');

        return [
            'nim' => 'NIM' . $faker->unique()->numerify('########'),
            'nama' => $faker->name,
            'password' => Hash::make('password'),
        ];
    }
}
