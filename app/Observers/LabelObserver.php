<?php

namespace App\Observers;

use App\Models\Log;
use App\Models\Label;
use App\Models\User;

class LabelObserver
{
    /**
     * Handle the Label "created" event.
     */
    public function created(Label $label): void
    {
        Log::create([
            'user_id' => auth()->id(),
            'ticket_id' => null,
            'log_name' => 'label_created',
            'description' => "Label '{$label->name}' created",
            'subject_type' => Label::class,
            'subject_id' => $label->id,
            'causer_type' => User::class,
            'causer_id' => auth()->id(),
            'properties' => [
                'name' => $label->name,
            ],
        ]);
    }

    /**
     * Handle the Label "updated" event.
     */
    public function updated(Label $label): void
    {
        $changes = $label->getChanges();
        unset($changes['updated_at']);

        if (empty($changes)) {
            return;
        }

        $original = $label->getOriginal();

        // Build the changes description
        $changesDescription = [];
        foreach ($changes as $field => $newValue) {
            $oldValue = $original[$field] ?? 'null';
            $changesDescription[] = "{$field}: '{$oldValue}' → '{$newValue}'";
        }

        Log::create([
            'user_id' => auth()->id(),
            'ticket_id' => null,
            'log_name' => 'label_updated',
            'description' => "Label '{$label->name}' updated : " . implode(', ', $changesDescription),
            'subject_type' => Label::class,
            'subject_id' => $label->id,
            'causer_type' => User::class,
            'causer_id' => auth()->id(),
            'properties' => [
                'old' => array_intersect_key($original, $changes),
                'new' => $changes,
            ],
        ]);
    }

    /**
     * Handle the Label "deleted" event.
     */
    public function deleted(Label $label): void
    {
        Log::create([
            'user_id' => auth()->id(),
            'ticket_id' => null,
            'log_name' => 'label_deleted',
            'description' => "Label '{$label->name}' deleted",
            'subject_type' => Label::class,
            'subject_id' => $label->id,
            'causer_type' => User::class,
            'causer_id' => auth()->id(),
            'properties' => [
                'name' => $label->name,
            ],
        ]);
    }

    /**
     * Handle the Label "restored" event.
     */
    public function restored(Label $label): void
    {
        Log::create([
            'user_id' => auth()->id(),
            'ticket_id' => null,
            'log_name' => 'label_restored',
            'description' => "Label '{$label->name}' restored",
            'subject_type' => Label::class,
            'subject_id' => $label->id,
            'causer_type' => User::class,
            'causer_id' => auth()->id(),
            'properties' => [],
        ]);
    }

    /**
     * Handle the Label "force deleted" event.
     */
    public function forceDeleted(Label $label): void
    {
        //
    }
}
