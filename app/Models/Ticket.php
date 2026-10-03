<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Ticket extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'created_by',
        'assigned_to',
        'category_id',
        'title',
        'message',
        'status',
        'priority',
    ];

     // User qui a créé le ticket
    public function Creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    // Agent auquel le ticket est assigné
    public function assignedAgent()
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }

    // Catégorie du ticket
    public function category()
    {
        return $this->belongsTo(Category::class);
    }


     public function logs()
    {
        return $this->hasMany(Log::class, 'ticket_id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
    public function labels()
{
    return $this->belongsToMany(Label::class, 'ticket_label');
}
    public function attachments()
    {
        return $this->hasMany(Attachment::class);
    }
}
