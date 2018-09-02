<?php

namespace App;

use Illuminate\Support\Collection;

class RestEmployeeRepository implements EmployeeRepository
{
    private $apiClient;

    public function __construct(EmployeeApiClient $apiClient)
    {
        $this->apiClient = $apiClient;
    }

    public function listEmployees(): Collection
    {
        /**
         * @var array $response [
         *     ['name' => 'Foo'],
         * ]
         */
        $response = $this->apiClient->listEmployees();

        return Collection::make($response)->map(function (array $employee) {
            return new EmployeeDto($employee['name'] ?? '');
        });
    }
}
