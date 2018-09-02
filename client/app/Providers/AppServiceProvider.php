<?php

namespace App\Providers;

use App\EloquentEmployeeRepository;
use App\EmployeeRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(EmployeeRepository::class, EloquentEmployeeRepository::class);
    }
}
