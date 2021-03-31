<?php

namespace Database\Factories;

use App\Models\Slick;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class SlickFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Slick::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' =>User::factory(),
            'body' => $this->faker->sentence,
        ];
    }
}
