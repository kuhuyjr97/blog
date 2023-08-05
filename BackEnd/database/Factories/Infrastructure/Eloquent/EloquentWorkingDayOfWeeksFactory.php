<?php

namespace Database\Factories\Infrastructure\Eloquent;

use App\Infrastructure\Eloquent\EloquentUser;
use App\Infrastructure\Eloquent\EloquentWorkingDayOfWeeks;
use Illuminate\Database\Eloquent\Factories\Factory;

class EloquentWorkingDayOfWeeksFactory extends Factory
{
	/**
	 * The name of the factory's corresponding model.
	 *
	 * @var string
	 */
	protected $model = EloquentWorkingDayOfWeeks::class;

	/**
	 * Define the model's default state.
	 *
	 * @return array
	 */
	public function definition(): array
	{
		$time_start_work = $this->faker->dateTimeBetween('08:00', '12:00');
		$time_end_work = (clone $time_start_work)->modify('+' . $this->faker->numberBetween(1, 8) . ' hours');

		return [
			'user_id' => optional(EloquentUser::first())->id ?? EloquentUser::factory()->create()->id,
			'day' => $this->faker->randomElement([0, 1, 2, 3, 4, 5, 6]),
			'time_start_work' => $time_start_work->format('H:i'),
			'time_end_work' => $time_end_work->format('H:i'),
		];
	}
}
