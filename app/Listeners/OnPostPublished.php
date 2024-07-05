<?php

namespace App\Listeners;

use App\Events\PostPublished;
use App\Services\NotificationService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class OnPostPublished
{
    /**
     * Create the event listener.
     */
    public function __construct(private NotificationService $notificationService)
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(PostPublished $event): void
    {
        //
        $this->notificationService->notifySubscribers($event->post->id);

    }
}
