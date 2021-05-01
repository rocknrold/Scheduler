<?php

namespace Database\Factories;

use App\Models\Appointment;
use App\Models\Client;
use Illuminate\Database\Eloquent\Factories\Factory;

class AppointmentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Appointment::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'client_id'=> Client::inRandomOrder()->first()->id,
            'date'=> $this->faker->dateTimeThisMonth()->format('Y-m-d'),
            'time'=> $this->faker->date($format = 'h:m', $max = 'now'),
            'status'=> $this->faker->randomElement(['finished', 'cancelled', 'ongoing']),
        ];
    }
}
