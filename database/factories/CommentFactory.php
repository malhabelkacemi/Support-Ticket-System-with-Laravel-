<?php

namespace Database\Factories;

use App\Helpers\OpenAIHelper;
use App\Models\Ticket;
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


       $ticket = Ticket::inRandomOrder()->first();

        return [
            'user_id' => User::inRandomOrder()->first()->id,
            'ticket_id' => Ticket::inRandomOrder()->first()->id,
            'body' => OpenAIHelper::generateComment(),
        ];
    /*
        return [
            'user_id' => User::inRandomOrder()->first()->id,
            'ticket_id' => Ticket::inRandomOrder()->first()->id,
            'body' => fake()->paragraph(),
        ];*/
    }
}
