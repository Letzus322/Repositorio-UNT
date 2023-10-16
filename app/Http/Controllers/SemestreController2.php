<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Semestre;

class SemestreController2 extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

    $semestres = Semestre::all();

    return view('semestres')->with('semestres', $semestres);
    }

    public function store(Request $request)
    {
        $request->validate([
            'año' => 'required|integer',
            'numero' => 'required|integer',
        ]);
        
        Semestre::create([
            'año' => $request->año,
            'numero' => $request->numero,
        ]);
    
        return redirect()->route('semestres')->with('success', 'Semestre creado exitosamente.');
    }
    

  
}
