<?php

namespace App;

class EmployeeApiConfiguration
{
    private $host;
    private $headers;

    public function __construct(string $host, array $headers = [])
    {
        $this->host = $host;
        $this->headers = $headers;
    }

    public function getHost()
    {
        return $this->host;
    }

    public function getHeaders()
    {
        return $this->headers;
    }
}
