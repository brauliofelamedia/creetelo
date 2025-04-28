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

            $response = response()->json($response->getBody());
            $response->setStatusCode(200);
            return $response;

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
                            'value' => ['wowfriday_ plan anual'],
                        ],
                        [
                            'field' => 'tags',
                            'operator' => 'eq',
                            'value' => ['creetelo_mensual'],
                        ],
                        [
                            'field' => 'tags',
                            'operator' => 'eq',
                            'value' => ['créetelo_mensual'],
                        ],
                        [
                            'field' => 'tags',
                            'operator' => 'eq',
                            'value' => ['creetelo_anual'],
                        ],
                        [
                            'field' => 'tags',
                            'operator' => 'eq',
                            'value' => ['créetelo_anual'],
                        ],
                        [
                            'field' => 'tags',
                            'operator' => 'eq',
                            'value' => ['directorio'],
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
                            'value' => ['wowfriday_ plan anual'],
                        ],
                        [
                            'field' => 'tags',
                            'operator' => 'eq',
                            'value' => ['creetelo_mensual'],
                        ],
                        [
                            'field' => 'tags',
                            'operator' => 'eq',
                            'value' => ['créetelo_mensual'],
                        ],
                        [
                            'field' => 'tags',
                            'operator' => 'eq',
                            'value' => ['creetelo_anual'],
                        ],
                        [
                            'field' => 'tags',
                            'operator' => 'eq',
                            'value' => ['créetelo_anual'],
                        ],
                    ],
                ],
            ];
        }

        $data = [
            'locationId' => $this->config->location_id,
            'page' => intval($page),
            'pageLimit' => 100,
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
    public function updateContact($user,$newData,$custom)
    {
        // Create an array with only the fields that need updating
        $updateData = [];
        
        // Only add fields to updateData if they exist in $newData and are different from user's current data
        if (isset($newData['name']) && $newData['name'] !== $user->first_name) {
            $updateData['firstName'] = $newData['name'];
        }
        
        if (isset($newData['last_name']) && $newData['last_name'] !== $user->last_name) {
            $updateData['lastName'] = $newData['last_name'];
        }
        
        if (isset($newData['whatsapp']) && $newData['whatsapp'] !== $user->whatsapp) {
            $updateData['phone'] = $newData['whatsapp'];
        }
        
        if (isset($newData['email']) && $newData['email'] !== $user->email) {
            $updateData['email'] = $newData['email'];
        }
        
        if (isset($newData['city']) && $newData['city'] !== $user->city) {
            $updateData['city'] = $newData['city'];
        }
        
        if (isset($newData['state']) && $newData['state'] !== $user->state) {
            $updateData['state'] = $newData['state'];
        }
        
        if (isset($newData['country']) && $newData['country'] !== $user->country) {
            $updateData['country'] = $newData['country'];
        }
        
        // Add custom fields if they exist
        if (!empty($custom)) {
            $updateData['customFields'] = $custom;
        }

        try {
            // Only proceed with the API call if there's data to update
            if (!empty($updateData)) {
            $response = $this->client->put('contacts/'.$user->contact_id, [
                'headers' => [
                'Accept' => 'application/json',
                'Version' => '2021-07-28',
                'Authorization' => 'Bearer ' . $this->config->access_token,
                ],
                'json' => $updateData,
            ]);
            
            return json_decode($response->getBody(), true);
            }
            
            // If nothing to update, return success message
            return ['success' => true, 'message' => 'No changes to update'];
        } catch (Exception $e) {
            if ($e->getCode() == 401) {
                return response()->json(['error' => 'Unauthorized request'], 401);
            }
            return response()->json(['error' => 'Request failed', 'message' => $e->getMessage()], 500);
        }
    }

}
