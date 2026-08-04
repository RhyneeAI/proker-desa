<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class AnnouncementFactory extends Factory
{
    public function definition(): array
    {
        $title = fake('id_ID')->sentence(5);

        return [
            'user_id' => User::inRandomOrder()->first()?->id,
            'title' => $title,
            'slug' => Str::slug($title).'-'.fake()->unique()->numberBetween(1, 99999),
            'content' => fake('id_ID')->paragraphs(2, true),
            'is_published' => true,
            'published_at' => fake()->dateTimeBetween('-1 month', 'now'),
        ];
    }
}
