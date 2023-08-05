<?php

namespace Database\Factories\Infrastructure\Eloquent;

use App\Enums\CategoryTypeRequestEnum;
use App\Infrastructure\Eloquent\EloquentRequestType;
use Illuminate\Database\Eloquent\Factories\Factory;

class EloquentRequestTypeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = EloquentRequestType::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'id' => $this->faker->randomElement([CategoryTypeRequestEnum::PARENT_REQ_OFF_REGULAR, CategoryTypeRequestEnum::PARENT_REQ_OFF_PERSONAL, CategoryTypeRequestEnum::TYPE_REQ_OFF_PERSONAL_WEDDING, CategoryTypeRequestEnum::TYPE_REQ_OFF_PERSONAL_ANNIVERSARY, CategoryTypeRequestEnum::PARENT_OVERTIME_REQUEST_TASK]),
            'parent_id' => $this->faker->optional()->randomNumber(),
            'category_id' => $this->faker->randomNumber(),
            'name' => $this->faker->word,
            'description' => $this->faker->sentence,
        ];
    }
}
