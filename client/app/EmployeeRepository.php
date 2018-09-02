<?php

namespace App;

use Illuminate\Support\Collection;

interface EmployeeRepository
{
    public function listEmployees(): Collection;
}
