<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'category', 'age_from', 'age_to', 'name', 'description', 'date', 'start_hour'
    ];

    public function users()
    {
        return $this->belongsToMany(User::class, 'event_hill', 'event_id', 'user_id');
    }

    public function sports()
    {
        return $this->belongsToMany(Sport::class, 'event_sport', 'event_id', 'sport_id');
    }
}