<?php

namespace App\Http\Controllers;
use App\Models\Carpeta;
use Illuminate\Http\Request;

class FormatoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($padre)
    {     
        // Obtén los registros de la tabla carpetas con la condición del padre si se proporciona
        if ($padre == 'null') {

            $data = Carpeta::whereNull('padre')->get();
            

        } else {
            $data = Carpeta::where('padre', $padre)->get();


        }
        

        // Muestra la vista con la lista de carpetas
        return view('formatos')->with('carpetas', $data)->with('padre', $padre);
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
        
        Carpeta::create([
            'nombreCarpeta' => $request->nombreCarpeta,
            'padre' => $request->padre,
        ]);
       
        return redirect()->route('registrarFormatos', ['formatoId' => 'null'])->with('success', 'Formato creado exitosamente.');
    }
    

  
}
