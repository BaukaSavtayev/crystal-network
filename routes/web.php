<?php

use App\Events\MessageSent;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;
use BeyondCode\LaravelWebSockets\Facades\WebSocketsRouter;

use BeyondCode\LaravelWebSockets\Server\Logger\WebsocketsLogger;
use Symfony\Component\Console\Output\ConsoleOutput;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
app()->singleton(WebsocketsLogger::class, function () {
    return (new WebsocketsLogger(new ConsoleOutput()))->enable(true);
});
WebSocketsRouter::webSocket('/app/{appKey}', \App\MyCustomWebSocketHandler::class);
//WebSocketsRouter::webSocket('/mywebsocket', \App\MyCustomWebSocketHandler::class);

Route::get('/{any}', function () {
    //broadcast(new \App\Events\WebsocketDemoEvent('adasdafgafa'));
    //broadcast(new MessageSent("SDASDASDASDASD"));
    return view('welcome');
})->where('any', '.*');
