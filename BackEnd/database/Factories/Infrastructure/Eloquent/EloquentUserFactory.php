<?php

namespace Database\Factories\Infrastructure\Eloquent;

use App\Infrastructure\Eloquent\EloquentDepartment;
use App\Infrastructure\Eloquent\EloquentRole;
use App\Infrastructure\Eloquent\EloquentUser;
use Illuminate\Database\Eloquent\Factories\Factory;

class EloquentUserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = EloquentUser::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'email' => $this->faker->text(10),
            'password' => $this->faker->text(30),
            'full_name' => $this->faker->text(10),
            'phone_number' => $this->faker->text(10),
            'address' => $this->faker->text(30),
            'img_url' => $this->faker->text(30),
            'role_id' => optional(EloquentRole::first())->id ?? EloquentRole::factory()->create()->id,
            'country_code' => $this->faker->text(10),
            'department_id' => optional(EloquentDepartment::first())->id ?? EloquentDepartment::factory()->create()->id,
        ];
    }
}
