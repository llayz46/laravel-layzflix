<?php

namespace Database\Factories;

use App\Models\Review;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Review>
 */
class ReviewFactory extends Factory
{
  protected $model = Review::class;

  public function definition(): array
  {
    return [
        'movie' => [
            'id' => '236235',
            'title' => 'The Gentlemen',
            'mediaType' => 'tv',
        ],
      'comment' => $this->faker->paragraph(),
      'note' => $this->faker->numberBetween(1, 5),
      'created_at' => Carbon::now(),
      'updated_at' => Carbon::now(),
      'user_id' => User::all()->random()->id,
    ];
  }
}
