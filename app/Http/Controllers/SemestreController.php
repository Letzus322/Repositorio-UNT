<?php

namespace App\Http\Controllers;
use App\Models\Carpeta;
use App\Models\Semestre;

use Illuminate\Http\Request;

class SemestreController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

    // Obtén todos los cursos para mostrar en la vista
    $semestres = Semestre::all();
    $formatos = Carpeta::whereNull('padre')->get();

    // Muestra la vista con la lista de cursos
    return view('semestres')->with('semestres', $semestres)->with('formatos', $formatos);
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
            'idCarpeta' => $request->idCarpeta,
        ]);
    
        return redirect()->route('registrarSemestres')->with('success', 'Semestre creado exitosamente.');
    }
    

  
}
