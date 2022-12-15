<?php

namespace App\Http\Controllers\Content;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function __invoke(Request $request)
    {
        return User::find($request->id);
    }
    public static function online($user_id, $status){
        DB::update("UPDATE users SET online = $status WHERE id = $user_id");
        \Log::info(Auth::id());
    }
}
