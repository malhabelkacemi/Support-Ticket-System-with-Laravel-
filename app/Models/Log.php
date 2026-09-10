<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class Log extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable =  [
        'user_id',
        'ticket_id',
        'log_name' ,
        'description' ,
        //'subject' ,
        //'causer' ,
        'properties' ,
    ];

       protected $casts = [
        'properties' => 'array',
    ];

        public function ticket()
    {
        return $this->belongsTo(Ticket::class);
    }

        public function user()
    {
        return $this->belongsTo(User::class);
    }

}
