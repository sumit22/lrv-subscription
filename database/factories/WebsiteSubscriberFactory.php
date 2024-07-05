<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\WebsiteSubscriber>
 */
class WebsiteSubscriberFactory extends Factory
{
    protected $model = \App\Models\WebsiteSubscriber::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'website_id' => fake()->randomDigitNotZero(1,20),
            'user_id' => fake()->randomDigitNotZero(1,100),
            'is_active' => 1,
        ];
    }
}
