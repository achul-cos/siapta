<?php

namespace Database\Factories;

use App\Models\Periode;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Periode>
 */
class PeriodeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Periode::class;

    public function definition(): array
    {
        $year = $this->faker->year;
        $month = $this->faker->month;
        $start = \Carbon\Carbon::create($year, $month, 1);
        $end = $start->copy()->endOfMonth();

        return [
            'tanggal_mulai' => $start,
            'tanggal_selesai' => $end,
            'nama_periode' => $start->translatedFormat('F Y'),
        ];
    }
}
