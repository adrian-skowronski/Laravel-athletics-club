<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EventSport extends Model
{
    use HasFactory;

    protected $table = 'event_sport';

    protected $fillable = [
        'event_id', 'sport_id'
    ];

    public function event()
    {
        return $this->belongsTo(Event::class, 'event_id');
    }

    public function sport()
    {
        return $this->belongsTo(Sport::class, 'sport_id');
    }
}