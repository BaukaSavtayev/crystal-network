<?php

namespace App\Providers;

use App\MyCustomWebSocketHandler;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;
use BeyondCode\LaravelWebSockets\Server\Logger\WebsocketsLogger;
use Symfony\Component\Console\Output\ConsoleOutput;
use BeyondCode\LaravelWebSockets\Facades\WebSocketsRouter;



class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {


    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        DB::listen(function ($query) {
            $query->sql;
            $query->bindings;
            $query->time;
        });
    }
}
