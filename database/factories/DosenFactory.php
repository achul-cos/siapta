<?php

namespace Database\Factories;

use App\Models\Dosen;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Dosen>
 */
class DosenFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Dosen::class;

    public function definition(): array
    {
        $faker = \Faker\Factory::create('id_ID');

        return [
            'nip' => 'NIP' . $faker->unique()->numerify('############'),
            'nama' => $faker->name,
            'password' => Hash::make('password'),
        ];
    }
}
