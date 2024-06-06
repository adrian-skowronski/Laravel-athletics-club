<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $primaryKey = 'user_id';

    protected $fillable = [
        'name', 'surname', 'email', 'password', 'birthdate', 'points', 'phone', 'role_id', 
        'remember_token', 'category','sport_id', 'approved'
    ];

    protected $hidden = [
        'password', 'remember_token', 'photo',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function isAdmin()
{
    return $this->role_id === 1;
}

public function isAthlete()
{
    return $this->role_id === 3; 
}

public function isCoach()
{
    return $this->role_id === 2; 
}

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function sport()
    {
        return $this->belongsTo(Sport::class, 'sport_id');
    }

    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id');
    }

    public function events()
    {
        return $this->belongsToMany(Event::class, 'event_hill', 'user_id', 'event_id');
    }

    public function trainings()
    {
        return $this->belongsToMany(Training::class, 'training_user', 'user_id', 'training_id');
    }
}