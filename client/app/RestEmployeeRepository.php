<?php

namespace App;

use Illuminate\Support\Collection;

class RestEmployeeRepository implements EmployeeRepository
{
    public function listEmployees(): Collection
    {
        $json = file_get_contents('http://foo:bar@localhost:8000');
        $decoded = json_decode($json, true);

        return Collection::make($decoded['data'])->map(function (array $employee) {
            return new EmployeeDto($employee['name'] ?? '');
        });
    }
}
