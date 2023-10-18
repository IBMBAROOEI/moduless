<?php

namespace barooei\User\Providers;

use Illuminate\Support\ServiceProvider;

class UserServiceProvider extends ServiceProvider
{

    public function register()
    {


        $this->loadRoutesFrom(__DIR__ . '/../Routes/user_routes.php');
        $this->loadViewsFrom(__DIR__  . '/../Resources/Views/','User');
        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');
    }
    public function boot()
    {


    }


}
