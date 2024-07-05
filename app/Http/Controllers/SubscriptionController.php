<?php

namespace App\Http\Controllers;

use App\Http\Requests\SubscribeRequest;
use App\Http\Requests\UnSubscribeRequest;
use App\Services\SubscriptionService;
use Illuminate\Http\JsonResponse;

class SubscriptionController extends Controller
{
    //
    public function __construct(private SubscriptionService $subscriptionService){}

    public function subscribe(SubscribeRequest $request): JsonResponse
    {

        
        $subscription = $this->subscriptionService->subscribe($request->get('website_id'), $request->get('user_id'));
        return response()->json([
            'subscription' => $subscription,
            'message' => 'Subscribed successfully'
        ], 201);
    }

    public function unsubscribe(UnSubscribeRequest $request) : JsonResponse
    {
        $subscription = $this->subscriptionService->unsubscribe($request->get('website_id'), $request->get('user_id'));
        return response()->json([
            'subscription' => $subscription,
            'message' => 'Unsubscribed successfully'
        ]);
    }
}
