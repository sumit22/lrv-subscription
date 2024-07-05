<?php

namespace App\Services;

use App\Models\WebsiteSubscriber;

class SubscriptionService
{
    public function __construct(private WebsiteSubscriber $websiteSubscriber)
    {
        //
    }

    public function subscribe(int $websiteId, int $userID): WebsiteSubscriber
    {
        // Subscribe the user to the website
        return $this->websiteSubscriber->updateOrCreate([
            'website_id' => $websiteId,
            'user_id' => $userID,
            
        ], ['is_active' => 1,]);
    }

    public function unsubscribe(int $websiteId, int $userID): WebsiteSubscriber
    {
        $webSubscription = $this->getSubscriptionByKeys($websiteId, $userID) ;

        $webSubscription->is_active = 0;
        $webSubscription->save();

        return $webSubscription;
    }

    //not used
    public function getSubscribers(int $websiteId, $paginationType='cursor'): array
    {
        // Get all subscribers of the website
        $query = $this->websiteSubscriber->query()->where('website_id', $websiteId);

        return match ($paginationType) {
            'cursor' => $query->cursorPaginate(10)->items(),
            'simple' => $query->get(),
            default => $query->cursorPaginate(10)->items(),
        };
    }

    public function isSubscribed(int $websiteId, int $userID): bool
    {
        // Check if the user is subscribed to the website

        return 0;
    }

    public function getSubscriptionByKeys(int $websiteId, int $userID ): WebsiteSubscriber
    {
        return $this->websiteSubscriber->query()->where('website_id', $websiteId)
            ->where('user_id', $userID)
            ->firstOrFail();
    }

    public function getModel(): WebsiteSubscriber
    {
        return $this->websiteSubscriber;
    }
}