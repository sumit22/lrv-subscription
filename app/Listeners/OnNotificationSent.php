<?php

namespace App\Listeners;

use App\Services\NotificationLogService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Events\NotificationSent;
use Illuminate\Queue\InteractsWithQueue;
use App\Notifications\PostPublishedByWebSite;
use Illuminate\Support\Facades\Log;

class OnNotificationSent
{
    /**
     * Create the event listener.
     */
    public function __construct(private NotificationLogService $notificationLogService)
    {
        //
        Log::alert("tapping notification sent event");
    }

    /**
     * Handle the event.
     */
    public function handle(NotificationSent $event): void
    {
        //
        //$this->notificationLogService->logNotificationSent($event);
        if($event->notification instanceof PostPublishedByWebSite) {
            echo "Notification sent event handled";
            $this->notificationLogService->logNotificationSent($event);
        }
    }
}
