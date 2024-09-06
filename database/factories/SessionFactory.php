<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
<<<<<<< HEAD
use App\Models\User;
=======

>>>>>>> 3479e3e55d733536665ad435339d28968671ccd3
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Session>
 */
class SessionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
<<<<<<< HEAD
            'user_id' => user::factory(),
            'name' => $this->faker->name,
            'description' => $this->faker->text,

=======
            //
>>>>>>> 3479e3e55d733536665ad435339d28968671ccd3
        ];
    }
}
