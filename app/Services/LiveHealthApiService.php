<?php 

namespace App\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class LiveHealthApiService
{
    protected $client;

    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => env('LIVEHEALTH_API_URL'),
            'timeout'  => 5.0,
        ]);
    }

    public function getResults($parameters)
    {
        try {
            $response = $this->client->request('GET', '/desired-endpoint', [
                'query' => $parameters,
                'headers' => [
                    'Authorization' => 'Bearer ' . env('LIVEHEALTH_API_TOKEN'),
                ],
            ]);

            return json_decode($response->getBody(), true);
        } catch (RequestException $e) {
            return [
                'error' => 'Request failed',
                'message' => $e->getMessage(),
            ];
        }
    }
}
