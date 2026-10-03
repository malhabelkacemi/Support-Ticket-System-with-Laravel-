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
            //'body' => fake()->paragraph(),
            //'body' => OpenAIHelper::generateComment(),
            'body' => fake()->randomElement([
                            'I have restarted the application, but the problem is still occurring.',
                            'The issue has been reproduced on another computer.',
                            'Could you please check the user permissions?',
                            'The problem seems to be resolved after restarting the system.',
                            'I have attached a screenshot showing the error.',
                            'The application is working correctly now. Thank you.',
                            'I still cannot access my account after resetting the password.',
                            'The error appears every time I try to open the application.',
                            'I have checked my internet connection, but the problem remains.',
                            'Could you please provide an update on this ticket?',
                            'The issue started this morning after the latest update.',
                            'I tried the suggested solution, but unfortunately it did not work.',
                            'The problem only occurs on my computer and not on other devices.',
                            'I can log in successfully, but I cannot access the requested page.',
                            'The application is very slow when I try to load the dashboard.',
                            'I have tested the issue again and it seems to be fixed now.',
                            'Could you please check whether my account has the correct access rights?',
                            'I have provided all the requested information. Please let me know if you need anything else.',
                            'The problem occurred again after a few hours of normal use.',
                            'Thank you for your help. Everything is working correctly now.',
                        ]),
        ];
    /*
        return [
            'user_id' => User::inRandomOrder()->first()->id,
            'ticket_id' => Ticket::inRandomOrder()->first()->id,
            'body' => fake()->paragraph(),
        ];*/
    }
}
