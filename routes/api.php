<?php

//use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\PasswordController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ResetPasswordController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VerificationController;
use Illuminate\Support\Facades\Broadcast;

use App\Http\Controllers\PostController;
use App\Http\Controllers\content\CommunityController;
use App\Http\Controllers\ChatsController;
use App\Http\Controllers\Content\SubscriptionController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//})
Broadcast::routes(['middleware' => ['auth:sanctum']]);

Route::middleware('guest')->group(function () {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', RegisterController::class);
    Route::post('/forgot-password', ForgotPasswordController::class);
    Route::post('/reset-password', ResetPasswordController::class);

    // guest verification (temporary auth)
    // Route::post('/verify-email/{id}/{hash}', [VerificationController::class, 'verify'])->name('verify');
    // Route::post('/verify-resend', [VerificationController::class, 'resend']);
});

Route::post('/verify-email/{id}/{hash}', [VerificationController::class, 'verify'])->name('verify');
Route::post('/verify-resend', [VerificationController::class, 'resend']);
Route::get('/user/{id}', \App\Http\Controllers\Content\UserController::class);

Route::get('/posts', PostController::class);
Route::middleware('auth:sanctum')->group(function () {
    Route::patch('/profile', ProfileController::class);
    Route::patch('/password', PasswordController::class);
    Route::get('/user', UserController::class);
    Route::post('/logout', [AuthController::class, 'logout']);

    Route::get('/chats', [ChatsController::class, 'index']);
    Route::post('/chats/createGroup', [ChatsController::class, 'createGroup']);

    Route::post('/messages/room/{id}/disable', [ChatsController::class, 'offNotice']);
    Route::get('/messages/room/{id}', [ChatsController::class, 'fetchMessages']);
    Route::post('/messages', [ChatsController::class, 'sendMessages']);

    Route::post('/post/create', [PostController::class, 'create']);
    Route::post('/community/create', [CommunityController::class, 'create']);

    Route::get('/subscriptions', SubscriptionController::class);
    Route::get('/subscriptions/subscribe/{id}', [SubscriptionController::class, 'subscribe']);
    Route::get('/subscriptions/unsubscribe/{id}', [SubscriptionController::class, 'unsubscribe']);

    //message controller



    Route::post('comment/create', [\App\Http\Controllers\Content\CommentsController::class, 'createComment']);
    //Route::post('/posts/update', PostController::class);
    //Route::post('/posts/delete', PostController::class);

    // in app verification
    // Route::post('/verify-email/{id}/{hash}', [VerificationController::class, 'verify'])->name('verify');
    // Route::post('/verify-resend', [VerificationController::class, 'resend']);
});
