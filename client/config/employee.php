<?php

return [
    'host' => env('EMPLOYEE_API_HOST', 'http://localhost:8000'),
    'credentials' => [
        'client_id' => env('EMPLOYEE_API_CLIENT_ID', 'foo'),
        'client_secret' => env('EMPLOYEE_API_CLIENT_SECRET', 'bar'),
    ],
];
