<?php

use App\Http\Controllers\Content\UserController;
use Illuminate\Support\Facades\Broadcast;
use App\Models\Room;
use App\Models\User;
/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    UserController::online($user->id, 1);
    return (int) $user->id === (int) $id;
});

//Broadcast::channel('chat', function ($user/**, $id**/) {
//    return $user;
//});
Broadcast::channel('typing.{id}', function ($user, $id) {
    //$user = User::find($id)->get();
    return true;
});
