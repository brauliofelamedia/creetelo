<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Nnjeim\World\World;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class WorldController extends Controller
{
    public function countries()
    {
        try {
            $countries = DB::table('countries')
                ->select('id', 'name')
                ->get();

            return $countries;
        } catch (\Exception $e) {
            Log::error('Error fetching countries:', ['error' => $e->getMessage()]);
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function states($country_id = null)
    {
        try {
            
            $response = DB::table('states')
                ->select('id', 'name')
                ->when($country_id, function ($query) use ($country_id) {
                    return $query->where('country_id', $country_id);
                })
                ->get();
            
            return response()->json($response);
        } catch (\Exception $e) {
            Log::error('Error fetching states:', ['error' => $e->getMessage()]);
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function cities($country_id, $state_id)
    {
        try {
            $response = DB::table('cities')
                ->select('id', 'name')
                ->where('country_id', $country_id)
                ->where('state_id', $state_id)
                ->get();
            
            return response()->json($response);
        } catch (\Exception $e) {
            Log::error('Error fetching cities:', ['error' => $e->getMessage()]);
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}