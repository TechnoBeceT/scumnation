<?php

namespace App\Notifications;

use App\Models\Users\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;
use NotificationChannels\Discord\DiscordChannel;
use NotificationChannels\Discord\DiscordMessage;

class BountyNotification extends Notification
{
    use Queueable;

    public $giver;
    public $taker;
    public $amount;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(User $giver, User $taker, $amount)
    {
        $this->giver   = $giver;
        $this->taker   = $taker;
        $this->amount  = $amount;
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
        return DiscordMessage::create("!scumnation_command #Announce {$this->giver->nickname} places a bounty on {$this->taker->nickname} for {$this->amount}. Total {$this->taker->bounty->amount}");
    }
}