<?php

namespace App\Providers;

use App\EmployeeApiClient;
use App\EmployeeApiConfiguration;
use App\EmployeeRepository;
use App\RestEmployeeRepository;
use GuzzleHttp\Client as GuzzleClient;
use Illuminate\Contracts\Config\Repository as ConfigRepository;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\ServiceProvider;
use Psr\Log\LoggerInterface;

class AppServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->bindEmployeeApiConfiguration();
        $this->bindEmployeeApiClient();
        $this->bindEmployeeRepository();
    }

    private function bindEmployeeApiConfiguration()
    {
        $this->app->bind(EmployeeApiConfiguration::class, function (Application $app) {
            $config = $app->make(ConfigRepository::class);
            $credentials = $config->get('employee.credentials');
            $basicAuthString = base64_encode("{$credentials['client_id']}:{$credentials['client_secret']}");

            return new EmployeeApiConfiguration($config->get('employee.host'), [
                'Accept' => 'application/json',
                'Authorization' => "Basic {$basicAuthString}",
            ]);
        });
    }

    private function bindEmployeeApiClient()
    {
        $this->app->bind(EmployeeApiClient::class, function (Application $app) {
            $httpClient = new GuzzleClient();
            $config = $app->make(EmployeeApiConfiguration::class);
            $logger = $app->make(LoggerInterface::class);

            return new EmployeeApiClient($httpClient, $config, $logger);
        });
    }

    private function bindEmployeeRepository()
    {
        $this->app->bind(EmployeeRepository::class, RestEmployeeRepository::class);
    }
}
