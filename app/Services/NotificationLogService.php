<?php

namespace App\Services;

use App\Models\NotificationLogs;
use App\Models\Post;
use Illuminate\Notifications\Events\NotificationSent;

class NotificationLogService {

    public function __construct(
        private NotificationLogs $notificationLogs
    ){
        info("Service invoked for logging notification");
    }

    public function logNotificationSent(NotificationSent $event)
    {
        info("Maing entries in notification logs");
        $post = $event->notification?->post;
        $user = $event->notifiable;


        $this->notificationLogs->create([
            'user_id' => $user->id,
            'post_id' => $post->id,
            'website_id' => $post->website->id,
        ]);
    }

    public function isNotified(Post $post, int $userID){
        return $this->notificationLogs->where('post_id', $post->id)
            ->where('user_id', $userID)
            ->exists();
    }
}