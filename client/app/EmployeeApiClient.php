<?php

namespace App;

use GuzzleHttp\ClientInterface;
use Psr\Log\LoggerInterface;

class EmployeeApiClient
{
    private $httpClient;
    private $config;
    private $logger;

    public function __construct(
        ClientInterface $httpClient,
        EmployeeApiConfiguration $config,
        LoggerInterface $logger
    ) {
        $this->httpClient = $httpClient;
        $this->config = $config;
        $this->logger = $logger;
    }

    public function listEmployees()
    {
        $json = file_get_contents('http://foo:bar@localhost:8000');
        $decoded = json_decode($json, true);

        return $decoded['data'] ?? [];
    }
}
