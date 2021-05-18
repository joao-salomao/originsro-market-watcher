<?php

namespace App\Http\Services;

use GuzzleHttp\Client;
use Psr\Http\Message\ResponseInterface;

class OriginsRoApiClient
{
    private $client = null;

    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => env("ORIGINS_RO_API_URL"),
            'headers' => [
                'x-api-key' => env("ORIGINS_RO_API_KEY")
            ]
        ]);
    }

    public function ping(): array
    {
        $response = $this->executeRequest('ping');
        return $response;
    }

    public function getMarketList(): array
    {
        $response = $this->executeRequest('market/list');
        return $response['shops'];
    }

    public function getItemsList(): array
    {
        $response = $this->executeRequest('items/list');
        return $response['items'];
    }

    public function getItemsIcons(): array
    {
        $response = $this->executeRequest('items/icons');
        return $response['icons'];
    }

    private function executeRequest(string $url): array
    {
        $response = $this->client->get($url);
        return $this->getResponseContent($response);
    }

    private function getResponseContent(ResponseInterface $response): array
    {
        $body = (string) $response->getBody();
        return json_decode($body, true);
    }
}
