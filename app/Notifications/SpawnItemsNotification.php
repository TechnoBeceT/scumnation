<?php

namespace App\Notifications;

use App\Models\Users\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;
use NotificationChannels\Discord\DiscordChannel;
use NotificationChannels\Discord\DiscordMessage;

class SpawnItemsNotification extends Notification
{
    use Queueable;

    public $user;

    public $commands;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(User $user, $commands)
    {
        $this->user     = $user;
        $this->commands = $commands;
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
        return DiscordMessage::create("!scumnation_spawn {$this->user->steamid},{$this->user->nickname}::::{$this->commands}");
    }
}
