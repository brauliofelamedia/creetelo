<?php

namespace App\Http\Controllers;

use App\Models\Skill;
use Illuminate\Http\Request;

class SkillController extends Controller
{
    public function create(Request $request)
    {
        // Valida la solicitud
        $request->validate([
            'name' => 'required|string|max:255|unique:skills,name',
        ]);

        // Crea el nuevo tag
        $skill = Skill::create([
            'name' => ucfirst($request->name),
        ]);

        // Devuelve el ID y el nombre del nuevo tag
        return response()->json([
            'id' => $skill->id,
            'name' => $skill->name,
        ]);
    }
}
