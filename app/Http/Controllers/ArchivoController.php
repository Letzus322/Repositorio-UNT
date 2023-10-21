<?php

namespace App\Http\Controllers;
use App\Models\Carpeta;
use Illuminate\Http\Request;
use App\Models\Archivo;

class ArchivoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {     
       
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
          
        ]);
        
        Archivo::create([
            'nombreArchivo' => $request->nombreArchivo,
            'padre' => $request->padre,
        ]);
       
        return redirect()->route('registrarFormatos', ['formatoId' => $request->padre])->with('success', 'Formato creado exitosamente.');
    }
    

  
}
