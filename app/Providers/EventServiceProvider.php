<?php
namespace App\Providers;

use App\Events\PointsUpdated;
use App\Listeners\UpdateUserRank;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        PointsUpdated::class => [
            UpdateUserRank::class,
        ],
    ];

    public function boot()
    {
        parent::boot();
    }
}
