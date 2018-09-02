<?php

namespace App;

use Illuminate\Support\Collection;

class EloquentEmployeeRepository implements EmployeeRepository
{
    private $employeeModel;

    public function __construct(Employee $employeeModel)
    {
        $this->employeeModel = $employeeModel;
    }

    /**
     * @return Collection|EmployeeDto[]
     */
    public function listEmployees(): Collection
    {
        return $this->employeeModel->all()->map(function (Employee $employee) {
            return new EmployeeDto($employee->name);
        });
    }
}
