<?php

namespace App\Service;

use Illuminate\Support\Facades\Http;
use Exception;
use Psr\Log\LoggerInterface;

abstract class ApiService
{
    protected $baseUrl;
    protected $apiToken;
    protected $logger;

    public function __construct($baseUrl, $apiToken, LoggerInterface $logger)
    {
        $this->baseUrl = $baseUrl;
        $this->apiToken = $apiToken;
        $this->logger = $logger;
    }

    protected function makeRequest($endpoint, $method, $data = [])
    {
        $this->logRequest($endpoint, $method, $data);
        $response = Http::withToken($this->apiToken)->$method($this->baseUrl . $endpoint, $data);

        $this->logResponse($response);
        if ($response->successful()) {
            return $response->json();
        }

        throw new Exception('API request failed: ' . $response->body());
    }

    public function get($endpoint, $data = [])
    {
        return $this->makeRequest($endpoint, 'GET', $data);
    }

    public function post($endpoint, $data = [])
    {
        return $this->makeRequest($endpoint, 'POST', $data);
    }

    public function put($endpoint, $data = [])
    {
        return $this->makeRequest($endpoint, 'PUT', $data);
    }

    public function delete($endpoint, $data = [])
    {
        return $this->makeRequest($endpoint, 'DELETE', $data);
    }

    public function setBaseUrl($baseUrl)
    {
        $this->baseUrl = $baseUrl;
    }

    public function setApiToken($apiToken)
    {
        $this->apiToken = $apiToken;
    }

    protected function logRequest($endpoint, $method, $data)
    {
        $this->logger->info("Request to $endpoint", ['method' => $method, 'data' => $data]);
    }

    protected function logResponse($response)
    {
        $this->logger->info("Response from API", ['response' => $response->body()]);
    }
}
