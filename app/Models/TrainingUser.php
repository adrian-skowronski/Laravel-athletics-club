<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrainingUser extends Model
{
    use HasFactory;

    protected $table = 'training_user';

    protected $fillable = [
        'training_id',  'user_id'
    ];
}