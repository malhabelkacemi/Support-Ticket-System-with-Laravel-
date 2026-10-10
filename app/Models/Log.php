<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\SoftDeletes;


class Log extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable =  [
        'user_id',
        'ticket_id',
        'log_name' ,
        'description' ,
        'subject_type',
        'subject_id',
        'causer_type',
        'causer_id',
        'properties' ,
    ];

       protected $casts = [
        'properties' => 'array',
    ];


        /**
     * Le modèle concerné par le log (Ticket, Category, User...)
     */
    public function subject(): MorphTo
    {
        return $this->morphTo();
    }

    /**
     * Le modèle qui a causé l'action (généralement User)
     */
    public function causer(): MorphTo
    {
        return $this->morphTo();
    }

        public function ticket()
    {
        return $this->belongsTo(Ticket::class)->withTrashed();;
    }

        public function user()
    {
        return $this->belongsTo(User::class)->withTrashed();;
    }

}
