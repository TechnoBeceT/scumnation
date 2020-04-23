<?php

namespace App\Notifications;

use App\Models\Users\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;
use NotificationChannels\Discord\DiscordChannel;
use NotificationChannels\Discord\DiscordMessage;

class DeathNotification extends Notification
{
    use Queueable;

    public $victim;
    public $killer;
    public $sector;
    public $distance;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(User $victim, User $killer, $sector, $distance)
    {
        $this->victim   = $victim;
        $this->killer   = $killer;
        $this->sector   = $sector;
        $this->distance = $distance;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return [DiscordChannel::class];
    }

    /**
     * Get the discord representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \NotificationChannels\Discord\DiscordMessage
     */
    public function toDiscord($notifiable)
    {
        return DiscordMessage::create("!scumnation_command {$this->victim->nickname} was killed by {$this->killer->nickname} in sector {$this->sector} at a distance of {$this->distance} meters.");
    }
}