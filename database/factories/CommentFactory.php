<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => $this->faker->numberBetween(1,30),
            'post_id' => $this->faker->numberBetween(2,4),
            'content' => $this->faker->text(150),
        ];
    }
}
