<?php

namespace App\Services;

use App\Models\Website;
use App\Notifications\PostPublishedByWebSite;

class NotificationService
{
    public function __construct(
        private PostsService $postsService, 
        private SubscriptionService $subscriptionService,
        private NotificationLogService $notificationLogService

    ){}

    public function notifySubscribers(int $postId): void
    {
        $post = $this->postsService->getPosts()->query()->find($postId);
        $subscriptionModel = $this->subscriptionService->getModel();

        $subscribers = $subscriptionModel->query()
            ->where('website_id', $post->website_id)
            ->cursor();

        foreach ($subscribers as $subscriber) {

           $user = $subscriber->subscriber;

           //notify only once
           if($this->notificationLogService->isNotified($post, $user->id)){
                info("User: {$user->id} already notified for post ID {$post->id}");
               continue;
            }

            $subscriber?->subscriber?->notify(
                //(new PostPublishedByWebSite($post))->delay(now()->addSeconds(1))//->onQueue('notification-queue')

                (new PostPublishedByWebSite($post))
            );
        }
    }


    public function notifyAllSubscribers()
    {
        $webSitesQuery = Website::query()->cursor();

        foreach ($webSitesQuery as $website) {
            $posts = $this->postsService->getPosts()->query()
                ->where('website_id', $website->id)
                ->cursor();

            foreach ($posts as $post) {
                $this->notifySubscribers($post->id);
            }
        }
    }

    
}