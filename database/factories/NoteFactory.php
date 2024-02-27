<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Note>
 */
class NoteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title = $this->faker->sentence;
        $slug = Str::slug($title, "-");

        return [
            'id' => $this->faker->uuid,
            'user_id' => User::factory(),
            'title' => $title,
            'slug' => $slug,
            'body' => $this->faker->paragraph,
            'recipient' => $this->faker->email,
            'send_date' => $this->faker->dateTimeBetween('now', '+1 month'),
            'is_published' => true,
            'heart_count' => $this->faker->numberBetween(0, 20),
        ];
    }
}
