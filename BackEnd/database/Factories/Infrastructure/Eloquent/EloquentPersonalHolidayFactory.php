<?php

namespace Database\Factories\Infrastructure\Eloquent;

use App\Enums\CategoryTypeRequestEnum;
use App\Infrastructure\Eloquent\EloquentPersonalHoliday;
use App\Infrastructure\Eloquent\EloquentUser;
use App\Infrastructure\Eloquent\EloquentRequestType;
use Illuminate\Database\Eloquent\Factories\Factory;

class EloquentPersonalHolidayFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = EloquentPersonalHoliday::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => optional(EloquentUser::first())->id ?? EloquentUser::factory()->create()->id,
            'request_type_id' => CategoryTypeRequestEnum::TYPE_REQ_OFF_PERSONAL_WEDDING,
            'day_left' => $this->faker->randomNumber(2),
        ];
    }
}
