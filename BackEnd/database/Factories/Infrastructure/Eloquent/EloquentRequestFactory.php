<?php

namespace Database\Factories\Infrastructure\Eloquent;

use App\Enums\CategoryTypeRequestEnum;
use App\Infrastructure\Eloquent\EloquentRequest;
use App\Infrastructure\Eloquent\EloquentUser;
use App\Infrastructure\Eloquent\EloquentRequestType;
use Illuminate\Database\Eloquent\Factories\Factory;

class EloquentRequestFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = EloquentRequest::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => optional(EloquentUser::first())->id ?? EloquentUser::factory()->create()->id,
            'user_accept_id' => optional(EloquentUser::first())->id ?? EloquentUser::factory()->create()->id,
            'accept_time' => $this->faker->dateTime(),
            'request_type_id' => $this->faker->randomElement([CategoryTypeRequestEnum::PARENT_REQ_OFF_REGULAR, CategoryTypeRequestEnum::PARENT_REQ_OFF_PERSONAL]),
            'category_id' => $this->faker->randomElement([CategoryTypeRequestEnum::OVERTIME_REQUEST, CategoryTypeRequestEnum::REQUEST_FIX_ATTENDANCE, CategoryTypeRequestEnum::REQUEST_OFF]),
            'status' => $this->faker->randomElement([0, 1]),
            'reason' => $this->faker->sentence,
            'start_from' => $this->faker->dateTimeBetween('-1 years', '+1 years'),
            'ended_at' => $this->faker->dateTimeBetween('-1 years', '+1 years'),
        ];
    }
}
