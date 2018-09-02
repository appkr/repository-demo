<?php

namespace App;

use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Psr7\Request;
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
        $response = $this->sendRequest();

        return $response['data'] ?? [];
    }

    /**
     * @param string $method
     * @param string $endpoint
     * @param array $headers
     * @param string $httpBody
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    private function sendRequest(
        string $method = 'GET',
        string $endpoint = '/',
        array $headers = [],
        string $httpBody = ''
    ) {
        $headers = array_merge($this->config->getHeaders(), $headers);
        $request = new Request($method, "{$this->config->getHost()}{$endpoint}", $headers, $httpBody);
        $logContext = [
            'request' => [
                'endpoint' => "{$method} {$endpoint}",
                'headers' => $headers,
                'body' => $httpBody,
            ],
        ];

        try {
            $response = $this->httpClient->send($request);
        } catch (RequestException $e) {
            $message = $e->getMessage();
            $errorContent = $e->getResponse()->getBody()->getContents() ?? null;
            if ($errorContent) {
                \GuzzleHttp\json_decode($errorContent, true);
            }

            $this->logger->error("[EmployeeApiClient] 오류가 발생했습니다.", array_merge($logContext, [
                'exception' => [
                    'code' => $e->getCode(),
                    'message' => $message,
                ],
            ]));

            throw $e;
        }
        $responseBody = \GuzzleHttp\json_decode($response->getBody()->getContents(), true);

        $this->logger->debug("[EmployeeApiClient] API 서버에서 응답을 수신했습니다.", array_merge($logContext, [
            'response' => $responseBody,
        ]));

        return $responseBody;
    }
}
