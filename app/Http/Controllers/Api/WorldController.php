<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Nnjeim\World\World;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Nnjeim\World\Models\Country;
use Nnjeim\World\Models\State;
use Nnjeim\World\Models\City;

class WorldController extends Controller
{
    public function countries()
    {
        try {
            $countries = Country::select('id','name','iso2')->get();
            return $countries;
        } catch (\Exception $e) {
            Log::error('Error fetching countries:', ['error' => $e->getMessage()]);
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function states(Request $request)
    {
        $country = $request->input('country');
        try {
            $response = State::select('id','name','country_code')
                ->when($country, function ($query) use ($country) {
                    return $query->where('country_code', $country);
                })
                ->get();
            
            return response()->json($response);
        } catch (\Exception $e) {
            Log::error('Error fetching states:', ['error' => $e->getMessage()]);
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function cities(Request $request)
    {
        $country = $request->input('country');
        $state = $request->input('state');

        $state = State::where('name', $state)->first();
        $state_id = $state->id;

        try {
            $response = City::select('id','name','country_code')
                ->where('country_code', $country)
                ->where('state_id', $state_id)
                ->get();
            
            return response()->json($response);
        } catch (\Exception $e) {
            Log::error('Error fetching cities:', ['error' => $e->getMessage()]);
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}