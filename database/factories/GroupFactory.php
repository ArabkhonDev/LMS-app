<?php

namespace Database\Factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Group>
 */
class GroupFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "name"=> $this->faker->name,
            'user_id'=>rand(1,50),
            'course_id'=>rand(1, 5),
            'start_time'=>Carbon::now()->subDays(rand(1,5)),
            'end_time'=>Carbon::now()->subDays(rand(1,5)),
        ];
    }
}
