<?php

namespace Database\Factories\Infrastructure\Eloquent;

use App\Enums\UpdateSourceEnum;
use App\Infrastructure\Eloquent\EloquentAttendance;
use App\Infrastructure\Eloquent\EloquentUser;
use Illuminate\Database\Eloquent\Factories\Factory;

class EloquentAttendanceFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = EloquentAttendance::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'user_id' => optional(EloquentUser::first())->id ?? EloquentUser::factory()->create()->id,
            'check_in' => $this->faker->dateTimeBetween('-1 years', 'now'),
            'check_out' => $this->faker->dateTimeBetween('-1 years', 'now'),
            'note' => $this->faker->text(30),
            'update_source' => $this->faker->randomNumber(UpdateSourceEnum::UPDATE_SOURCE_ORIGINAL, UpdateSourceEnum::UPDATE_SOURCE_UPDATED),
            'timework' => $this->faker->time(),
            'overtime' => $this->faker->time(),
            'time_late' => $this->faker->time(),
        ];
    }
}
