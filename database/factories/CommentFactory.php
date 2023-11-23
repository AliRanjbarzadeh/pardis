<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Comment>
 */
class CommentFactory extends Factory
{
	/**
	 * Define the model's default state.
	 *
	 * @return array<string, mixed>
	 */
	public function definition(): array
	{
		$user = User::where('type', '=', 'user')->get()->random();
		$createdAt = fake()->dateTimeBetween('-30 days');
		$status = fake()->randomElement(['pending', 'approved', 'rejected']);
		$declineReason = null;
		if ($status == 'rejected') {
			$declineReason = $this->faker->persianParagraph;
		}

		return [
			'user_id' => $user->id,
			'status' => $status,
			'full_name' => $user->name,
			'email' => $user->email ?? '',
			'mobile' => $user->mobile ?? '',
			'body' => $this->faker->persianParagraph,
			'decline_reason' => $declineReason,
			'created_at' => $createdAt,
			'updated_at' => $createdAt,
		];
	}
}
