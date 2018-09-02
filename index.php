<?php

function login()
{
    $auth_closure = function () {
        header('WWW-Authenticate: Basic realm="Repository Demo"');
        header('HTTP/1.0 401 Unauthorized');
        exit;
    };

    if (!isset($_SERVER['PHP_AUTH_USER'])) {
        call_user_func($auth_closure);
    }

    $valid = $_SERVER['PHP_AUTH_USER'] === 'foo';
    $valid = $_SERVER['PHP_AUTH_PW'] === 'bar';
    if (!$valid) {
        call_user_func($auth_closure);
    }

    return true;
}

login();

header('Content-type: application/json');
echo json_encode([
    'data' => [
        ['name' => 'lorem'],
        ['name' => 'ipsum'],
        ['name' => 'dolor'],
    ],
]);
