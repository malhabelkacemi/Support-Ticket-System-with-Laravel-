<?php

namespace App\Observers;

use App\Models\Log;
use App\Models\Category;
use App\Models\User;

class CategoryObserver
{
    /**
     * Handle the Category "created" event.
     */
    public function created(Category $category): void
    {
        Log::create([
            'user_id' => auth()->id(),
            'ticket_id' => null,
            'log_name' => 'category_created',
            'description' => "Category '{$category->name}' created",
            'subject_type' => Category::class,
            'subject_id' => $category->id,
            'causer_type' => User::class,
            'causer_id' => auth()->id(),
            'properties' => [
                'name' => $category->name,
                'slug' => $category->slug,
                'is_visible' => $category->is_visible,
            ],
        ]);
    }

    /**
     * Handle the Category "updated" event.
     */
    public function updated(Category $category): void
    {
        $changes = $category->getChanges();
        unset($changes['updated_at']);

        if (empty($changes)) {
            return;
        }

        $original = $category->getOriginal();

        // Build the changes description
        $changesDescription = [];
        foreach ($changes as $field => $newValue) {
            $oldValue = $original[$field] ?? 'null';
            $changesDescription[] = "{$field}: '{$oldValue}' → '{$newValue}'";
        }

        Log::create([
            'user_id' => auth()->id(),
            'ticket_id' => null,
            'log_name' => 'category_updated',
            'description' => "Category '{$category->name}' updated : " . implode(', ', $changesDescription),
            'subject_type' => Category::class,
            'subject_id' => $category->id,
            'causer_type' => User::class,
            'causer_id' => auth()->id(),
            'properties' => [
                'old' => array_intersect_key($original, $changes),
                'new' => $changes,
            ],
        ]);
    }

    /**
     * Handle the Category "deleted" event.
     */
    public function deleted(Category $category): void
    {
        Log::create([
            'user_id' => auth()->id(),
            'ticket_id' => null,
            'log_name' => 'category_deleted',
            'description' => "Category '{$category->name}' deleted",
            'subject_type' => Category::class,
            'subject_id' => $category->id,
            'causer_type' => User::class,
            'causer_id' => auth()->id(),
            'properties' => [
                'name' => $category->name,
                'slug' => $category->slug,
            ],
        ]);
    }

    /**
     * Handle the Category "restored" event.
     */
    public function restored(Category $category): void
    {
        Log::create([
            'user_id' => auth()->id(),
            'ticket_id' => null,
            'log_name' => 'category_restored',
            'description' => "Category '{$category->name}' restored",
            'subject_type' => Category::class,
            'subject_id' => $category->id,
            'causer_type' => User::class,
            'causer_id' => auth()->id(),
            'properties' => [],
        ]);
    }

    /**
     * Handle the Category "force deleted" event.
     */
    public function forceDeleted(Category $category): void
    {
        //
    }
}
