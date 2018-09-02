<?php

namespace App;

class EmployeeApiClient
{
    public function listEmployees()
    {
        $json = file_get_contents('http://foo:bar@localhost:8000');
        $decoded = json_decode($json, true);

        return $decoded['data'] ?? [];
    }
}
