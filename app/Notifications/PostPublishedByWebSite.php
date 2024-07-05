<?php

namespace App\Notifications;

use App\Models\Post;
use App\Models\Website;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class PostPublishedByWebSite extends Notification implements ShouldQueue
{
    use Queueable;

    //public $connection = 'database';
    //public $queue = 'notification-queue';

    public Website|null $website;

    /**
     * Create a new notification instance.
     */
    public function __construct(public Post $post)
    {
        //
        Log::info('PostPublishedByWebSite constructor');


        $this->website = $this->post->website;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)->subject('New Post Published By ' . $this->website->url)
                    ->line($this->post->title)
                    ->line(Str::limit($this->post->content, 100, '...'));
    }
}
