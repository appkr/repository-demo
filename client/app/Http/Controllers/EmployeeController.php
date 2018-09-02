<?php

namespace App\Http\Controllers;

use App\Employee;
use Illuminate\Http\JsonResponse;

class EmployeeController extends Controller
{
    public function listEmployees()
    {
        return new JsonResponse([
            'data' => Employee::query()->get(['name'])
        ]);
    }
}
