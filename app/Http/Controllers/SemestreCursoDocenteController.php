<?php

namespace App\Http\Controllers;

use App\Models\SemestreCursoDocente;
use Illuminate\Http\Request;

class SemestreCursoDocenteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            
            // Otros campos que desees validar
        ]);

        SemestreCursoDocente::create([
            'semestre_id' => $request->semestre_id,
            'curso_id' => $request->curso_id,
            'docente_id' => $request->docente_id,
            'Acreditacion'=> $request->Acreditacion,
            // Otros campos que desees guardar
        ]);

    }
}
