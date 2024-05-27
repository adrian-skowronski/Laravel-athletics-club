<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Training extends Model
{
    use HasFactory;

    protected $fillable = [
        'trainer_id', 'sport_id', 'date', 'start_time', 'end_time'
    ];

    public function trainer()
    {
        return $this->belongsTo(User::class, 'trainer_id', 'user_id');
    } //trainer_id relacja 1 do 1 z user_id z tabeli users
 
}