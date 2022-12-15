<?php
namespace App;

use App\Http\Controllers\Content\UserController;
use BeyondCode\LaravelWebSockets\WebSockets\WebSocketHandler;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Ratchet\ConnectionInterface;
use Ratchet\RFC6455\Messaging\MessageInterface;
use Ratchet\WebSocket\MessageComponentInterface;
use Illuminate\Support\Facades\Log;
use function Psy\debug;


class MyCustomWebSocketHandler extends WebSocketHandler
{
    public $connect_users_id = [];
    public function onOpen(ConnectionInterface $conn)
    {
        parent::onOpen($conn);
        //if ($this->user_id) UserController::online($this->user_id, 1);
        //Log::info('On Open');
        // TODO: Implement onOpen() method.
    }

    public function onClose(ConnectionInterface $conn)
    {
        parent::onClose($conn);
        if ($this->connect_users_id["$conn->socketId"])
            UserController::online($this->connect_users_id["$conn->socketId"], 0);
        Log::info('On Close');
        $oadsad = json_encode($this->connect_users_id);

    }

//    public function onError(ConnectionInterface $conn, \Exception $e)
//    {
//        // TODO: Implement onError() method.
//        //\Log::debug('ON ERROR');
//        parent::onError($conn, $e);
//    }
//
    public function onMessage(ConnectionInterface $conn, MessageInterface $msg)
    {
        // TODO: Implement onMessage() method.
        $user_id = preg_match('/App\.Models\.User\.(?P<user_id>\d{1,15})/', $msg, $matches);
        if($user_id) {
            $this->connect_users_id["$conn->socketId"] = $matches['user_id'];
            UserController::online($user_id, 1);
        }
        parent::onMessage($conn, $msg);
    }
}
