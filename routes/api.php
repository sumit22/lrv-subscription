<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\SubscriptionController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('posts/create', [PostController::class,'create']);
Route::post('posts/publish', [PostController::class,'publish']);
Route::get('posts', [PostController::class,'index']);

Route::post('subscriptions/subscribe', [SubscriptionController::class, 'subscribe'])->name('subscribe');
Route::post('subscriptions/unsubscribe', [SubscriptionController::class, 'unsubscribe'])->name('unsubscribe');
