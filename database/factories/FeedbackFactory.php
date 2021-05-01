<?php

namespace Database\Factories;

use App\Models\Feedback;
use App\Models\Client;
use Illuminate\Database\Eloquent\Factories\Factory;

class FeedbackFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Feedback::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'client_id'=> Client::inRandomOrder()->first()->id,
            'note'=> $this->faker->text($maxNbChars = 200),
        ];
    }
}
