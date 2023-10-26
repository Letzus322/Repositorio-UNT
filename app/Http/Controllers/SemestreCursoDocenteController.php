<?php

namespace App\Http\Controllers;

use App\Models\SemestreCursoDocente;
use Illuminate\Http\Request;
use App\Models\Semestre;
use App\Models\User;
use App\Models\Cursos;
use Illuminate\Support\Facades\Storage;

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

        $semestre = Semestre::find($request->semestre_id);
        $docente = User::find($request->docente_id);
        $curso = Cursos::find($request->curso_id);

        $carpeta = 'Semestre'. '_' . $semestre->año . '_' . $semestre->numero;
        $carpeta = $carpeta . '/'.  $docente->name;

        $carpeta2 ='Semestre'. '_' . $semestre->año . '_' . $semestre->numero . '/' . $docente->name . '/'.  $curso -> NombreCurso;



 
        try {
            // Verificar si la carpeta no existe
            if (!Storage::exists($carpeta2)) {
                // Intentar crear la carpeta
                Storage::makeDirectory($carpeta2);
               
            } else {
                            // 

            }
        } catch (\Exception $e) {            // 

          
        }






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
