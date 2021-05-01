<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::factory(10)->create();
        \App\Models\Client::factory(20)->create();
        \App\Models\Appointment::factory(30)->create();
        \App\Models\UserAppointment::factory(30)->create();
        \App\Models\Feedback::factory(10)->create();
    }
}
