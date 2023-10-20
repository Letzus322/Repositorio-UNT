<?php

namespace App\Http\Controllers;
use App\Models\Semestre;
use Illuminate\Http\Request;

class FormatoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

    // Obtén todos los cursos para mostrar en la vista
    $semestres = Semestre::all();


    // Muestra la vista con la lista de cursos
    return view('semestres')->with('semestres', $semestres);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
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
    
        return redirect()->route('registrarSemestres')->with('success', 'Semestre creado exitosamente.');
    }
    

  
}
