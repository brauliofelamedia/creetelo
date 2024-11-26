<?php

namespace App\Services;
use GuzzleHttp\Client;
use App\Models\Config;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use GuzzleHttp\Exception\ClientException;
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

    public function checkToken()
    {
        try {
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

        } catch (Exception $e) {
            if ($e->getCode() == 401) {
                return response()->json(['error' => 'Unauthorized request'], 401);
            }

            return response()->json(['error' => 'Request failed'], 500);
        }
    }

    public function getContacts($name,$page)
    {   
        if($name){
            $filters = [
                [
                    'group' => 'AND',
                    'filters' => [
                        [
                            'field' => 'firstNameLowerCase',
                            'operator' => 'contains',
                            'value' => $name,
                        ],
                        [
                            'field' => "lastNameLowerCase",
                            'operator' => "exists"
                        ],
                    ],
                ],
                [
                    'group' => 'OR',
                    'filters' => [
                        [
                            'field' => 'tags',
                            'operator' => 'eq',
                            'value' => ['wowfriday_plan mensual'],
                        ],
                        [
                            'field' => 'tags',
                            'operator' => 'eq',
                            'value' => ['wowfriday_plan anual'],
                        ],
                    ],
                ],
            ];
        } else {
            $filters = [
                [
                    'group' => 'OR',
                    'filters' => [
                        [
                            'field' => 'tags',
                            'operator' => 'eq',
                            'value' => ['wowfriday_plan mensual'],
                        ],
                        [
                            'field' => 'tags',
                            'operator' => 'eq',
                            'value' => ['wowfriday_plan anual'],
                        ],
                    ],
                ],
            ];
        }

        $data = [
            'locationId' => $this->config->location_id,
            'page' => intval($page),
            'pageLimit' => 20,
            'filters' => $filters,
        ];

        try {
            $response = $this->client->post('contacts/search', [
                'headers' => [
                    'Accept' => 'application/json',
                    'Version' => '2021-07-28',
                    'Authorization' => 'Bearer ' . $this->config->access_token,
                ],
                'json' => $data,
            ]);
            
            return json_decode($response->getBody(), true);

        } catch (Exception $e) {
            if ($e->getCode() == 401) {
                return response()->json(['error' => 'Unauthorized request'], 401);
            }
            return response()->json(['error' => 'Request failed'], 500);
        }
    }

    public function searchContact($name)
    {   
        try {     
            $response = $this->client->get('contacts', [
                'headers' => [
                    'Accept' => 'application/json',
                    'Version' => '2021-07-28',
                    'Authorization' => 'Bearer ' . $this->config->access_token,
                ],
                'query' => [
                    'query' => $name,
                    'locationId' => $this->config->location_id
                ]
            ]);
            return json_decode($response->getBody(), true);
        } catch (Exception $e) {
            if ($e->getCode() == 401) {
                return response()->json(['error' => 'Unauthorized request'], 401);
            }
            return response()->json(['error' => 'Request failed'], 500);
        }
    }

    public function getContact($id)
    {
        try {
            $response = $this->client->get('contacts/'.$id, [
                'headers' => [
                    'Accept' => 'application/json',
                    'Version' => '2021-07-28',
                    'Authorization' => 'Bearer ' . $this->config->access_token,
                ],
            ]);
            return json_decode($response->getBody(), true);
        } catch (Exception $e) {
            if ($e->getCode() == 401) {
                return response()->json(['error' => 'Unauthorized request'], 401);
            }
            return response()->json(['error' => 'Request failed'], 500);
        }
    }

    //SyncContact
    public function putContact($id)
    {
        $user = User::where('contact_id',$id)->first();

        try {
            $response = $this->client->put('contacts/'.$id, [
                'headers' => [
                    'Accept' => 'application/json',
                    'Version' => '2021-07-28',
                    'Authorization' => 'Bearer ' . $this->config->access_token,
                ],
                'json' => [
                    'firstName' => $user->name,
                    'lastName' => $user->last_name,
                    'name' => $user->name.' '.$user->last_name,
                    'email' =>  $user->email,
                    'phone' =>  $user->phone,
                    'address1' =>  $user->address,
                    'city' => $user->city,
                    'state' => $user->state,
                    'postalCode' => $user->postal_code,
                    'country' => $user->country,
                ],
            ]);
        
            return json_decode($response->getBody(), true);
        } catch (Exception $e) {
            if ($e->getCode() == 401) {
                return response()->json(['error' => 'Unauthorized request'], 401);
            }
            return response()->json(['error' => 'Request failed', 'message' => $e->getMessage()], 500);
        }
    }
    
}