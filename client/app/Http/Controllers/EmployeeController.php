<?php

namespace App\Http\Controllers;

use App\EmployeeRepository;
use Illuminate\Http\JsonResponse;

class EmployeeController extends Controller
{
    public function listEmployees(
        EmployeeRepository $repository
    ) {
        $employees = $repository->listEmployees();

        return new JsonResponse([
            'data' => $employees,
        ]);
    }
}
