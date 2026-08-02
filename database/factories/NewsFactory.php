<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class NewsFactory extends Factory
{
    public function definition(): array
    {
        $title = fake('id_ID')->sentence(6);

        return [
            'user_id' => User::inRandomOrder()->first()?->id,
            'title' => $title,
            'slug' => Str::slug($title).'-'.fake()->unique()->numberBetween(1, 99999),
            'content' => fake('id_ID')->paragraphs(4, true),
            'thumbnail' => null,
            'thumbnail_alt' => null,
            'is_published' => true,
            'published_at' => fake()->dateTimeBetween('-2 months', 'now'),
        ];
    }
}
