<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Nnjeim\World\World;
use Illuminate\Support\Facades\Log;

class WorldController extends Controller
{
    public function countries()
    {
        try {
            $countries = World::countries([
                'fields' => 'id,name'  // Changed from array to string
            ]);

            Log::info('Countries response:', ['response' => $countries]);

            return $countries;
        } catch (\Exception $e) {
            Log::error('Error fetching countries:', ['error' => $e->getMessage()]);
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function states($country_id = null)
    {
        try {
            Log::info('Requesting states for country_id: ' . $country_id);
            
            $response = World::states([
                'fields' => 'id,name',
                'filters' => [
                    'country_id' => $country_id
                ]
            ]);
            
            Log::info('States response:', ['response' => $response]);
            
            return response()->json($response);
        } catch (\Exception $e) {
            Log::error('Error fetching states:', ['error' => $e->getMessage()]);
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function cities($country_id, $state_id)
    {
        try {
            $response = World::cities([
                'fields' => 'id,name',
                'filters' => [
                    'country_id' => $country_id,
                    'state_id' => $state_id
                ]
            ]);

            Log::info('Cities response:', ['response' => $response]);
            
            return response()->json($response);
        } catch (\Exception $e) {
            Log::error('Error fetching cities:', ['error' => $e->getMessage()]);
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}