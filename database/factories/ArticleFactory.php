<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Article>
 */
class ArticleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $title = $title = str(str($this->faker->sentence(4))->title())->replace('.', '');
        return [
            'user_id' => \App\Models\User::factory(),
            'category_id' => rand(1, 4),
            'title' => $title,
            'slug' => str($title . str()->random(6))->slug(),
            'body' => $this->faker->sentence(100),
            'created_at' => $created_at = now()->subDays(rand(1, 100)),
            'updated_at' => $created_at
        ];
    }
}
