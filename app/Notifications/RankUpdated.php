<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class RankUpdated extends Notification
{
    use Queueable;

    protected $newRank;

    public function __construct($newRank)
    {
        $this->newRank = $newRank;
    }

    public function via($notifiable)
    {
        return ['mail', 'database'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->line('Twoja ranga została zaktualizowana do: ' . $this->newRank)
                    ->line('Powodzenia dalej!');
    }

    public function toArray($notifiable)
    {
        return [
            'new_rank' => $this->newRank,
        ];
    }
}
