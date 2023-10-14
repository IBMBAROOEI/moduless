<?php

namespace barooei\Task\Providers;

use Illuminate\Support\ServiceProvider;

class TaskServiceProvider extends ServiceProvider
{


    public function register()
    {
        $this->loadRoutesFrom(__DIR__ . '/../Routes/task_routes.php');
        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');
    }

    public function boot()
    {



    }
}
