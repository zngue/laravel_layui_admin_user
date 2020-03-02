<?php

namespace Zngue\User;

use Illuminate\Routing\Router;
use Illuminate\Support\ServiceProvider;
use Zngue\User\Commands\UserCommands;
use Zngue\User\Http\Middleware\UserLogin;
use Zngue\User\Http\Middleware\UserPermission;

class UserService extends ServiceProvider
{
    public function boot(Router $router)
    {
        $router->aliasMiddleware('checkLogin', UserLogin::class);
        $router->aliasMiddleware('UserPermission', UserPermission::class);

        $this->loadRoutesFrom(__DIR__ . "/../routes/web.php");
        $this->loadViewsFrom(__DIR__ . '/../views', 'zng');
        $this->publishes([
            __DIR__ . '/../assets' => public_path('zng/assets'),
        ]);

        if ($this->app->runningInConsole()) {
            $this->commands([
                UserCommands::class
            ]);
        }
    }
}
