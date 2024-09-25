<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\UrlTrafic>
 */
class UrlTraficFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id'          => User::all()->random()->id,
            'url'              => fake()->url(),
            'short'             => Str::lower( Str::random( 6 ) ),
            'clicks' => rand( 100, 9999 ),
        ];
    }
}
