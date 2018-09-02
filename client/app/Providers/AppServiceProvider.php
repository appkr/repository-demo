<?php

namespace App\Providers;

use App\EmployeeRepository;
use App\RestEmployeeRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(EmployeeRepository::class, RestEmployeeRepository::class);
    }
}
