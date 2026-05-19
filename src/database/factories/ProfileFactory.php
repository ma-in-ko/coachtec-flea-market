<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProfileFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'postal_code' => '123-4567',
            'address' => '東京都',
            'building' => 'テストビル',
            'image' => null,
        ];
    }
}
