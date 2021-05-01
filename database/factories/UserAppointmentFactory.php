<?php

namespace Database\Factories;

use App\Models\UserAppointment;
use App\Models\User;
use App\Models\Appointment;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserAppointmentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = UserAppointment::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id'=> User::inRandomOrder()->first()->id,
            'appointment_id'=> Appointment::inRandomOrder()->first()->id,
        ];
    }
}
