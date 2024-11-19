<?php

namespace App\Services;
use GuzzleHttp\Client;
use App\Models\Config;
use Illuminate\Support\Facades\Crypt;

class ContactServices
{
    private $client;
    private $config;

    public function __construct()
    {
        $this->config = Config::where('id',1)->first();
        $this->client = new Client([
            'base_uri' => 'https://services.leadconnectorhq.com',
        ]);
    }

    public function getContacts()
    {   
        $response = $this->client->get('contacts', [
            'headers' => [
                'Accept' => 'application/json',
                'Version' => '2021-07-28',
                'Authorization' => 'Bearer ' . $this->config->access_token,
            ],
            'query' => [
                'locationId' => $this->config->location_id
            ]
        ]);
        
        return json_decode($response->getBody(), true);
    }

    public function getContact($id)
    {
        $response = $this->client->get('contacts/'.$id, [
            'headers' => [
                'Accept' => 'application/json',
                'Version' => '2021-07-28',
                'Authorization' => 'Bearer ' . $this->config->access_token,
            ],
        ]);
        
        return json_decode($response->getBody(), true);
    }
}