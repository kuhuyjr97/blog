<?php

namespace Database\Factories\Infrastructure\Eloquent;

use App\Infrastructure\Eloquent\EloquentHoliday;
use Illuminate\Database\Eloquent\Factories\Factory;

class EloquentHolidayFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = EloquentHoliday::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->word,
            'day' => $this->faker->numberBetween(1, 31),
            'month' => $this->faker->numberBetween(1, 12),
            'country_code' => $this->faker->countryCode,
        ];
    }
}
