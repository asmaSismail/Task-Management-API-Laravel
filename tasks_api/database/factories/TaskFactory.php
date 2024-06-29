<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::all()->random()->id,
            'titre' => $this->faker->unique()->sentence(),
            'description' => $this->faker->text(),
            'date_Echeance' => $this->faker->date(), 
            'statut' => $this->faker->randomElement(['Done', 'Processed']),
            'created_at' =>  $this->faker->dateTimeBetween('-1 year', 'now'),
            'updated_at' =>  $this->faker->dateTimeBetween('-1 year', 'now'),
        ];
    }
}
