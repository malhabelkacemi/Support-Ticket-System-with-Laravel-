<?php

namespace Database\Seeders;

use App\Models\Label;
use App\Models\Ticket;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TicketLabelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tickets = Ticket::all();
        $labels = Label::all();

        foreach ($tickets as $ticket) {
            $randomLabels = $labels
                ->random(rand(1, 3))
                ->pluck('id')
                ->toArray();

            $ticket->labels()->attach($randomLabels);
        }

    }
}
