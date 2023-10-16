<?php

namespace App\Http\Controllers;
use App\Models\Cursos;
use App\Models\User;
use App\Models\Semestre;
use App\Models\SemestreCursoDocente;
use Illuminate\Support\Facades\Auth; // Importa la clase Auth

use Illuminate\Http\Request;

class NormalSesionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $id = Auth::user()->id;
       // dd($id);
    

        $data = SemestreCursoDocente::with(['semestre'])
        ->join('semestres', 'semestre_curso_docente.semestre_id', '=', 'semestres.id')
        ->select('semestres.id', 'semestres.año', 'semestres.numero')
        ->where('semestre_curso_docente.docente_id', $id)
        ->distinct('semestres.id')

        ->get();
        //dd($data);
    return view('normalSession')->with('semestres', $data);
    }

 

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
   
    }
    

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
