<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Training extends Model
{
    use HasFactory;

    protected $fillable = [
        'trainer_id', 'date', 'start_time', 'end_time'
    ];

    public function trainer()
    {
        return $this->belongsTo(User::class, 'trainer_id', 'user_id');
    } //trainer_id relacja 1 do 1 z user_id z tabeli users
 
    public function users()
    {
        return $this->belongsToMany(User::class, 'training_user', 'training_id', 'user_id');
    }
}