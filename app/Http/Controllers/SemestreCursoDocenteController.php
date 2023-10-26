<?php

namespace App\Http\Controllers;

use App\Models\SemestreCursoDocente;
use Illuminate\Http\Request;
use App\Models\Semestre;
use App\Models\User;
use App\Models\Cursos;

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



        $carpeta = public_path($carpeta);

 


        // Verificar si la carpeta no existe
        if (!file_exists($carpeta)) {
            // Intentar crear la carpeta
            if (mkdir($carpeta, 0755, true)) {
                echo 'Carpeta creada con éxito.';
            } else {
                echo 'Error al crear la carpeta.';
            }
        } else {
            echo 'La carpeta ya existe.';
        }

        $carpeta2 ='Semestre'. '_' . $semestre->año . '_' . $semestre->numero . '/' . $docente->name . '/'.  $curso -> NombreCurso;

        $carpeta2 = public_path($carpeta2);
        if (!file_exists($carpeta2)) {
            // Intentar crear la carpeta
            if (mkdir($carpeta2, 0777, true)) {
                echo 'Carpeta creada con éxito.';
            } else {
                echo 'Error al crear la carpeta.';
            }
        } else {
            echo 'La carpeta ya existe.';
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
