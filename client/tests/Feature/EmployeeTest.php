<?php

namespace Tests\Feature;

use App\EmployeeApiClient;
use App\RestEmployeeRepository;
use Tests\TestCase;

class EmployeeTest extends TestCase
{
    public function testListEmployees()
    {
        $this->app->when(RestEmployeeRepository::class)
            ->needs(EmployeeApiClient::class)
            ->give(function () {
                $service = \Mockery::mock(EmployeeApiClient::class);
                $service->shouldReceive('listEmployees')->once()->andReturn([
                    ['name' => 'Foo'],
                ]);
                return $service;
            });

        $response = $this->get('employees');

        $actual = $response->json()['data'][0]['name'] ?? null;
        $this->assertEquals('Foo', $actual);
    }
}
