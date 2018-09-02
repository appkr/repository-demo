<?php

namespace App\Http\Controllers;

use App\Employee;
use App\EmployeeDto;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Collection;

class EmployeeController extends Controller
{
    public function listEmployees()
    {
        /** @var Collection|EmployeeDto[] $employees */
        $employees = Employee::query()->get()
            ->map(function (Employee $employee) {
                return new EmployeeDto($employee->name);
            });

        return new JsonResponse([
            'data' => $employees,
        ]);
    }
}
