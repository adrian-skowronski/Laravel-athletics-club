<?php
namespace App\Listeners;

use App\Events\PointsUpdated;
use App\Models\Category;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class UpdateUserRank
{
    public function __construct()
    {
        //
    }

    public function handle(PointsUpdated $event)
    {
        $user = $event->user;
        $points = $user->points;

        $category = Category::where('min_points', '<=', $points)
                            ->orderBy('min_points', 'desc')
                            ->first();

        if ($category && $user->category_id !== $category->category_id) {
            $user->category_id = $category->category_id;
            $user->save();

            $user->notify(new \App\Notifications\RankUpdated($category->name));
        }
    }
}
