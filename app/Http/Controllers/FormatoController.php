<?php

namespace App\Http\Controllers;
use App\Models\Formato;
use Illuminate\Http\Request;

class FormatoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

    // Obtén todos los cursos para mostrar en la vista
    $formatos = Formato::all();


    // Muestra la vista con la lista de cursos
    return view('formatos')->with('formatos', $formatos);
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
        ]);
        
        Formato::create([
            'nombreFormato' => $request->nombreFormato,
            'año' => $request->año,
        ]);
    
        return redirect()->route('registrarFormatos')->with('success', 'Formato creado exitosamente.');
    }
    

  
}
