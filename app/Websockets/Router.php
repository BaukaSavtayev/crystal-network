<?php

class Router extends \BeyondCode\LaravelWebSockets\Server\Router
{
    public function echo()
    {
        $this->get('/app/{appKey}', \App\MyCustomWebSocketHandler::class);
        $this->post('/apps/{appId}/events', \BeyondCode\LaravelWebSockets\HttpApi\Controllers\TriggerEventController::class);
        $this->get('/apps/{appId}/channels', \BeyondCode\LaravelWebSockets\HttpApi\Controllers\FetchChannelsController::class);
        $this->get('/apps/{appId}/channels/{channelName}', \BeyondCode\LaravelWebSockets\HttpApi\Controllers\FetchChannelController::class);
        $this->get('/apps/{appId}/channels/{channelName}/users', \BeyondCode\LaravelWebSockets\HttpApi\Controllers\FetchUsersController::class);
    }
}
