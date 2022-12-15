<?php

namespace App\Http\Controllers;

use App\Events\MessageSent;
use App\Models\Message;
use App\Models\Room;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PHPUnit\Util\Json;
use function Psy\debug;
use function React\Promise\Stream\first;
use function RingCentral\Psr7\str;

class ChatsController extends Controller
{

    public function index()
    {
        $user_id = Auth::id();
        $user_rooms = substr(User::find(Auth::id())->rooms, 0, -1);
        $user_rooms_count = count(explode(',',$user_rooms));
//        if ($user_rooms) return Room::select('rooms.*', 'messages.message')->distinct()
//            ->leftJoin('messages', 'messages.room_id', '=', 'rooms.id')
//            ->whereRaw("rooms.id in ($user_rooms)")->get();
        //$user_rooms = DB::select("SELECT rooms.id, messages.message FROM rooms LEFT JOIN messages ON messages.room_id = rooms.id WHERE rooms.id in ($user_rooms) GROUP BY rooms.id");
        $user_rooms = DB::select("SELECT rooms.id, rooms.access_users, rooms.is_conversation, rooms.name, have_no_read, messages.message FROM rooms LEFT JOIN (SELECT room_id, max(id) as id, sum(case WHEN have_read NOT RLIKE '" . ",$user_id,|^$user_id,|,$user_id$|^$user_id$" . "' then 1 else 0 end) as have_no_read FROM messages GROUP BY room_id) as messages2 ON messages2.room_id = rooms.id LEFT JOIN messages ON messages.id = messages2.id WHERE rooms.id in ($user_rooms) GROUP BY rooms.id, messages.message, rooms.name, have_no_read LIMIT $user_rooms_count");
        foreach ($user_rooms as $user_room){
            $names = explode('|', $user_room->name);
            if (!$user_room->is_conversation){
                if (Auth::user()->name == $names[0]) $user_room->name = $names[1];
                else $user_room->name = $names[0];
            }
            $rooms["$user_room->id"] = [
                'name' => $user_room->name,
                'have_no_read' => $user_room->have_no_read,
                'access_users' => $user_room->access_users,
                'activeMessage' => $user_room->message
            ];
        }

        return $rooms;
    }
    public function fetchMessages($id)
    {
        if ((int) $id == 0) return die('Hacking attempt!');
//        $data = DB::table('rooms as r')
//            ->crossJoin('users as u')
//            ->select("r.access_users", "r.is_conversation", "r.name as room_name", 'm.id','m.message', 'u.name', 'm.created_at')
//            ->rightJoin('messages as m', 'u.id', '=', 'm.user_id')
//            ->whereRaw("m.room_id = $id AND r.id = $id")
//            ->get();
        $data = DB::table('users as u')
            ->select('m.id','m.message', 'm.have_read', 'u.name as author', 'u.id as author_id', 'm.created_at')
            ->rightJoin('messages as m', 'u.id', '=', 'm.user_id')
            ->whereRaw("m.room_id = $id")
            ->get();

        return $data;
    }
    public function sendMessages(Request $request)
    {
        $room = $this->createOrGetRoom($request);
        if ($room){
            $activeUsers = DB::table('users')
                ->select('id')
                ->whereRaw("id in ($room->access_users) AND online = 1")
                ->get();
            $activeUsersStr = '';
            foreach ($activeUsers as $activeUser){$activeUsersStr .= ',' . $activeUser->id;}
            $activeUsers = explode(',', $activeUsersStr);
            $access_users = explode(',', $room->access_users);
            $have_reads = '';
            foreach ($access_users as $user){
                if ($user == Auth::id()) continue;
                if (in_array($user, $activeUsers)) $have_reads .= "$user:1,";
                else $have_reads .= "$user:0,";
            }
            $message = auth()->user()->messages()->create([
                'message' => $request->message,
                'access_users' => $room->access_users,
                //'have_read' => $room->access_users,
                'have_read' => $have_reads,
                'room_id' => $room->id
            ]);
            if ($message) {
                //$access_users = explode(',', $room->access_users);
                $access_users_d = explode(',', $room->access_users_d);
                foreach ($access_users_d as $access_user_d){
                    $access_user_d = explode(':', $access_user_d);
                    if ($access_user_d[1] < time() && $access_user_d[1] != 1){
                        broadcast(new MessageSent($message->load('user'), $access_user_d[0]))->toOthers();
                    }
                }
                return ['status' => 'success', 'message' => $message];
            }
        } else {
            return die('Такого чата не существует');
        }

//        $room = Room::firstOrCreate([
//            'access_users' => $access_user,
//            'is_conversation' => 0
//        ]);


    }
    public function createOrGetRoom(Request $request)
    {
        $user_id = Auth::id();
        if ($request->room_id ){
            if ((int) $request->room_id == 0) return die('Hacking attempt!');
            $room = DB::table('rooms')->whereRaw("id = $request->room_id AND access_users RLIKE '" . ",$user_id,|^$user_id,|,$user_id$|^$user_id$'")->first();
        } else {
            if ((int) $request->addressee_id == 0) return die('Hacking attempt!');
            $access_users = ((int) $request->addressee_id < $user_id) ? $request->addressee_id . ',' . $user_id: $user_id . ',' . $request->addressee_id;
            $room = DB::table('rooms')->where('access_users', '=', "$access_users")->get()->first();
            if (!$room){
                $access_users_d = ((int) $request->addressee_id < $user_id) ? "$request->addressee_id:0,$user_id:0": "$user_id:0,$request->addressee_id:0";
                $names = DB::table('users')->select('name')->whereRaw("id in ($user_id, $request->addressee_id)")->get();
                $room = Room::create([
                    'access_users' => $access_users,
                    'access_users_d' => $access_users_d,
                    'name' => $names[0]->name . '|' . $names[1]->name,
                    'is_conversation' => 0
                ]);
                $roomId = $room->id;
                $result = DB::update("UPDATE users SET rooms = concat(rooms, {$roomId}, ',') WHERE id IN ($access_users)");
            }
        }
        return $room;
    }
    public function createGroup(Request $request){
        return (int) 'adas';
        $user_id = Auth::id();
        if ($request->group){
            foreach ($request->group['users'] as $user){
                if ((int) $user == 0) return die('Hacking attempt!');
            }
            $users = implode(',', $request->group['users']);
            $friends  = DB::table('subscriptions')
                ->selectRaw('count(*) as count')
                ->whereRaw("friend_1 = $user_id AND friend_2 in ($users) AND status = 1")
                ->orWhereRaw("friend_2 = $user_id AND friend_1 in ($users) AND status = 1")
                ->get();
            if ($friends[0]->count != count($request->group['users'])){
                return 'Hacking attempt!';
            }

        }
        $group = $this->createOrGetRoom($request, 1);

        return $group;
    }
    public function offNotice(Request $request)
    {
        $user_id = Auth::id();
        $disable_duration = $request['disable_duration'];
        if ((int) $request->id == 0 || !in_array($disable_duration, [1,2,3,4,5,6,7]) )
        {
            return die('Hacking attempt!');
        }
        switch ($disable_duration){
            case 1:
                $disable_duration = 1;
                break;
            case 2:
                $disable_duration = 3;
                break;
            case 3:
                $disable_duration = 7;
                break;
            case 4:
                $disable_duration = 14;
                break;
            case 5:
                $disable_duration = 30;
                break;
            case 6:
                $disable_duration = 365;
                break;
            case 7:
                $disable_duration = 0;
                break;
            default:
                die('Hacking attempt!');
        }
        if ($disable_duration !== 0){
            //$disable_duration = date('Y-m-d H:i:s', time() + ($disable_duration * 24 * 60 * 60));
            $disable_duration =  time() + ($disable_duration * 24 * 60 * 60);
        } else $disable_duration = 1;
        $disable_duration = $user_id . ':' . $disable_duration;
        $result = DB::update("UPDATE rooms SET access_users_d = REGEXP_REPLACE(access_users_d,'" . "[,]{1}$user_id:[1-9]+|^$user_id:[1-9]+|$user_id:0" . "', '$disable_duration') WHERE id = $request->id AND access_users RLIKE ',$user_id,|^$user_id,|,$user_id$|^$user_id$'");
        return $result;
    }
}
