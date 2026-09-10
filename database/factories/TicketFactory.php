<?php

namespace Database\Factories;

use App\Helpers\OpenAIHelper;
use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Ticket>
 */
class TicketFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    public function definition(): array
    {
        $content = OpenAIHelper::generateTicketTitleAndMessage();

        return [
           'created_by' => User::where('role', 'user')
                ->inRandomOrder()
                ->first()
                ->id,

            'assigned_to' => User::where('role', 'agent')
                ->inRandomOrder()
                ->first()
                ->id,

            'category_id' => Category::inRandomOrder()
                ->first()
                ->id,

            'title' => $content['title'],  // better than : 'title' => fake()->sentence(6),

            'message' => $content['message'],

            'status' => fake()->randomElement([
                'open',
                'in_progress',
                'archived',
                'closed',
            ]),

            'priority' => fake()->randomElement([
                'low',
                'medium',
                'high',
                'urgent',
            ]),
        ];
    }
}
