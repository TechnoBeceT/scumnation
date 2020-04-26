<?php

namespace App\Notifications;

use App\Models\Users\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;
use NotificationChannels\Discord\DiscordChannel;
use NotificationChannels\Discord\DiscordMessage;

class BountyRewardNotification extends Notification
{
    use Queueable;

    public $killer;
    public $victim;
    public $amount;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(User $killer, User $victim, $bounty)
    {
        $this->killer   = $killer;
        $this->victim   = $victim;
        $this->bounty   = $bounty;
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
        return DiscordMessage::create("!scumnation_command #Announce {$this->killer->nickname} has killed {$this->victim->nickname} and claimed the {$this->bounty} coin bounty.");
    }
}