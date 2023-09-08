<?php

namespace barooei\User\Providers;

use Illuminate\Support\ServiceProvider;

class UserServiceProvider extends ServiceProvider
{
    public function boot()
    {

    
        $this->loadRoutesFrom(__DIR__ . '/../Routes/user_routes.php');
        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');
    }

    public function register()
    {
        //
    }
}
