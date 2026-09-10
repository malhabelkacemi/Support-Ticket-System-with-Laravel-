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
     $logs = OpenAIHelper::generateLogs(5);

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
}
