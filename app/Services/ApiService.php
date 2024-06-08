<?php

namespace App\Services;

use GuzzleHttp\Client;

class ApiService
{
    protected $client;

    public function __construct()
    {
        $this->client = new Client();
    }

    public function callApi($endpoint, $method = 'GET', $data = [], $username = '', $password = '')
    {
        $headers = [
            'Authorization' => 'Basic '. base64_encode("$username:$password"),
            'Accept' => 'application/json',
            'Content-Type' => 'application/json'
        ];

        $options = [
            'headers' => $headers,
        ];

        if (!empty($data)) {
            $options['json'] = $data;
        }

        $response = $this->client->request($method, $endpoint, $options);

        return json_decode($response->getBody()->getContents(), true);
    }
}
