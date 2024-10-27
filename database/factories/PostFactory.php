<?php

namespace Database\Factories;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(),
            'slug' => $this->faker->slug(),
            'content' => $this->faker->paragraph(),
            'image_url' => $this->faker->imageUrl(),
            'views' => $this->faker->randomDigit(),
            'likes' => $this->faker->randomDigit(),
            'user_id' => User::factory()->create()->id,
        ];
    }
}
