<?php

namespace Database\Seeders;

use App\Helpers\OpenAIHelper;
use App\Models\Log;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
            $logs = [
                        [
                            'log_name' => 'Ticket created',
                            'description' => 'The ticket was created successfully.',
                            'properties' => [
                                'action' => 'created',
                            ],
                        ],
                        [
                            'log_name' => 'Ticket assigned',
                            'description' => 'The ticket was assigned to an agent.',
                            'properties' => [
                                'action' => 'assigned',
                            ],
                        ],
                        [
                            'log_name' => 'Status changed',
                            'description' => 'The ticket status was changed to in progress.',
                            'properties' => [
                                'action' => 'status_changed',
                                'new_status' => 'in_progress',
                            ],
                        ],
                        [
                            'log_name' => 'Priority changed',
                            'description' => 'The ticket priority was changed to high.',
                            'properties' => [
                                'action' => 'priority_changed',
                                'new_priority' => 'high',
                            ],
                        ],
                        [
                            'log_name' => 'Comment added',
                            'description' => 'A new comment was added to the ticket.',
                            'properties' => [
                                'action' => 'comment_added',
                            ],
                        ],
                    ];

                    foreach ($logs as $log) {
                        Log::create([
                            'user_id' => User::inRandomOrder()->first()->id,
                            'ticket_id' => Ticket::inRandomOrder()->first()->id,
                            'log_name' => $log['log_name'],
                            'description' => $log['description'],
                            'properties' => $log['properties'],
                        ]);
                    }
                }


      /*$logs = OpenAIHelper::generateLogs(5);

        foreach ($logs as $log) {
            Log::create([
                'user_id' => User::inRandomOrder()->first()->id,
                'ticket_id' => Ticket::inRandomOrder()->first()->id,
                'log_name' => $log['log_name'],
                'description' => $log['description'],
                'properties' => $log['properties'],
            ]);
    }*/
  }

