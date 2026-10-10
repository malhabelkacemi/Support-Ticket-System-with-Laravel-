<?php

namespace App\Observers;

use App\Models\Log;
use App\Models\Ticket;
use App\Models\User;

class TicketObserver
{

    /**
     * Log automatique lors de la création d'un ticket
     */

    /**
     * Handle the Ticket "created" event.
     */
    public function created(Ticket $ticket): void
    {
           Log::create([
            'user_id' => auth()->id(),
            'ticket_id' => $ticket->id,
            'log_name' => 'ticket_created',
            'description' => "Ticket '{$ticket->title}' created",
            'subject_type' => Ticket::class,
            'subject_id' => $ticket->id,
            'causer_type' => User::class,
            'causer_id' => auth()->id(),
            'properties' => [
                'title' => $ticket->title,
                'status' => $ticket->status,
                'priority' => $ticket->priority,
                'category_id' => $ticket->category_id,
                'assigned_to' => $ticket->assigned_to,
            ],
        ]);
    }

    /**
     * Handle the Ticket "updated" event.
     */
    public function updated(Ticket $ticket): void
    {

        $changes = $ticket->getChanges();
        unset($changes['updated_at']);

        if (empty($changes)) {
            return;
        }

        $original = $ticket->getOriginal();

        // Construire la description des changements
        $changesDescription = [];
        foreach ($changes as $field => $newValue) {
            $oldValue = $original[$field] ?? 'null';
            $changesDescription[] = "{$field}: '{$oldValue}' → '{$newValue}'";
        }

        Log::create([
            'user_id' => auth()->id(),
            'ticket_id' => $ticket->id,
            'log_name' => 'ticket_updated',
            'description' => "Ticket '{$ticket->title}' updated : " . implode(', ', $changesDescription),
            'subject_type' => Ticket::class,
            'subject_id' => $ticket->id,
            'causer_type' => User::class,
            'causer_id' => auth()->id(),
            'properties' => [
                'old' => array_intersect_key($original, $changes),
                'new' => $changes,
            ],
        ]); //
    }

    /**
     * Handle the Ticket "deleted" event.
     */
    public function deleted(Ticket $ticket): void
    {
            Log::create([
            'user_id' => auth()->id() ,
            'ticket_id' => $ticket->id,
            'log_name' => 'ticket_deleted',
            'description' => "Ticket '{$ticket->title}' deleted",
            'subject_type' => Ticket::class,
            'subject_id' => $ticket->id,
            'causer_type' => User::class,
            'causer_id' => auth()->id(),
            'properties' => [
                'title' => $ticket->title,
                'status' => $ticket->status,
                'priority' => $ticket->priority,
            ],
        ]);
    }

    /**
     * Handle the Ticket "restored" event.
     */
    public function restored(Ticket $ticket): void
    {
            Log::create([
            'user_id' => auth()->id(),
            'ticket_id' => $ticket->id,
            'log_name' => 'ticket_restored',
            'description' => "Ticket '{$ticket->title}' restored",
            'subject_type' => Ticket::class,
            'subject_id' => $ticket->id,
            'causer_type' => User::class,
            'causer_id' => auth()->id(),
            'properties' => [],
        ]);
    }

    /**
     * Handle the Ticket "force deleted" event.
     */
    public function forceDeleted(Ticket $ticket): void
    {
        //
    }
}
