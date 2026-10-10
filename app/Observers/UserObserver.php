<?php

namespace App\Observers;

use App\Models\Log;
use App\Models\User;

class UserObserver
{
    /**
     * Handle the User "created" event.
     */
    public function created(User $user): void
    {
        Log::create([
            'user_id' => auth()->id(),
            'ticket_id' => null,
            'log_name' => 'user_created',
            'description' => "User '{$user->name}' created",
            'subject_type' => User::class,
            'subject_id' => $user->id,
            'causer_type' => User::class,
            'causer_id' => auth()->id(),
            'properties' => [
                'name' => $user->name,
                'email' => $user->email,
            ],
        ]);
    }

    /**
     * Handle the User "updated" event.
     */
    public function updated(User $user): void
    {
        $changes = $user->getChanges();
        unset($changes['updated_at']);
        unset($changes['password']); // Never log the password

        if (empty($changes)) {
            return;
        }

        $original = $user->getOriginal();

        // Build the changes description
        $changesDescription = [];
        foreach ($changes as $field => $newValue) {
            $oldValue = $original[$field] ?? 'null';
            $changesDescription[] = "{$field}: '{$oldValue}' → '{$newValue}'";
        }

        Log::create([
            'user_id' => auth()->id(),
            'ticket_id' => null,
            'log_name' => 'user_updated',
            'description' => "User '{$user->name}' updated : " . implode(', ', $changesDescription),
            'subject_type' => User::class,
            'subject_id' => $user->id,
            'causer_type' => User::class,
            'causer_id' => auth()->id(),
            'properties' => [
                'old' => array_intersect_key($original, $changes),
                'new' => $changes,
            ],
        ]);
    }

    /**
     * Handle the User "deleted" event.
     */
    public function deleted(User $user): void
    {
        Log::create([
            'user_id' => auth()->id(),
            'ticket_id' => null,
            'log_name' => 'user_deleted',
            'description' => "User '{$user->name}' deleted",
            'subject_type' => User::class,
            'subject_id' => $user->id,
            'causer_type' => User::class,
            'causer_id' => auth()->id(),
            'properties' => [
                'name' => $user->name,
                'email' => $user->email,
            ],
        ]);
    }

    /**
     * Handle the User "restored" event.
     */
    public function restored(User $user): void
    {
        Log::create([
            'user_id' => auth()->id(),
            'ticket_id' => null,
            'log_name' => 'user_restored',
            'description' => "User '{$user->name}' restored",
            'subject_type' => User::class,
            'subject_id' => $user->id,
            'causer_type' => User::class,
            'causer_id' => auth()->id(),
            'properties' => [],
        ]);
    }

    /**
     * Handle the User "force deleted" event.
     */
    public function forceDeleted(User $user): void
    {
        //
    }
}
