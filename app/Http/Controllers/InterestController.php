<?php

namespace App\Http\Controllers;

use App\Models\Interest;
use Illuminate\Http\Request;

class InterestController extends Controller
{
    public function create(Request $request)
    {
        // Valida la solicitud
        $request->validate([
            'name' => 'required|string|max:255|unique:interests,name',
        ]);

        // Crea el nuevo tag
        $interest = Interest::create([
            'name' => ucfirst($request->name),
        ]);

        // Devuelve el ID y el nombre del nuevo tag
        return response()->json([
            'id' => $interest->id,
            'name' => $interest->name,
        ]);
    }
}
