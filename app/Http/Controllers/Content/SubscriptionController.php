<?php

namespace App\Http\Controllers\Content;

use App\Http\Controllers\Controller;
use App\Models\Subscriptions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SubscriptionController extends Controller
{

    public function __invoke(){
        $user_id = Auth::id();
//        return DB::table('subscriptions')
//            ->leftJoin('users', function($join){
//                $join->on('users.id','=','subscriptions.friend_1')
//                    ->orOn('users.id','=','subscriptions.friend_2');
//            })->where('subscriptions.friend_1', "=", $user_id)
//            ->orWhere('subscriptions.friend_2', "=", $user_id)
//            ->get();
        //$subscriptions = DB::select("SELECT u.id, u.name, u.surname, u.online, u.avatar, s.friend_2, s.status FROM subscriptions as s CROSS JOIN users as u WHERE (u.id = s.friend_1 AND s.friend_1 <> $user_id AND s.friend_2 = $user_id) OR (u.id = s.friend_2 AND s.friend_2 <> $user_id  AND s.friend_1 = $user_id )");
        $subscriptions = DB::table('subscriptions as s')
            ->crossJoin('users as u')
            ->select("u.id", "u.name", "u.surname", "u.online", "u.avatar", "u.is_group", "s.friend_2", "s.status")
            ->whereRaw("(u.id = s.friend_1 AND s.friend_1 <> $user_id) AND s.friend_2 = $user_id")
            ->orWhereRaw("(u.id = s.friend_2 AND s.friend_2 <> $user_id) AND s.friend_1 = $user_id")
            ->get();
        return $subscriptions;
    }
    public function subscribe(Request $request){
        $user_id = Auth::id();
        if ((int) $request->id == 0 || $user_id == $request->id) return die('Hacking attempt!');
        $old_request = DB::table('subscriptions')
            ->whereRaw("
            (friend_1 = $user_id AND friend_2 = $request->id)
            OR
            (friend_1 = $request->id AND friend_2 = $user_id AND status = 1)
            ")
            ->get();
        if (count($old_request)) {
            return [$old_request,('Заявка уже отправлена вами или вы уже в друзьях. Hacking attempt!')];
        }
        else{
            $friend_request = DB::update("UPDATE subscriptions SET status = 1 WHERE friend_1 = $request->id AND friend_2 = $user_id");//AND status = 0
            if ($friend_request){
                return 'Теперь вы друзья';
            } else {
//                $subscription = Subscriptions::create([
//                   'friend_1' => $user_id,
//                   'friend_2' => $request->id,
//                   'status' => 0
//                ]);
//                $subscription = new Subscriptions();
//                $subscription->friend_1 = $user_id;
//                $subscription->friend_2 = $request->id;
//                $subscription->status = 0;
//                $subscription->save();
                $subscription = DB::table('subscriptions')->insert([
                    'friend_1' => $user_id,
                    'friend_2' => $request->id,
                    'status' => 0
                ]);
                if ($subscription) return 'Вы подписаны';
                else return 'АШИБКА';
            }
        }
    }
    public function unsubscribe(Request $request){

    }
}
