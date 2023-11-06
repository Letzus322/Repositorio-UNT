<?php

namespace App\Http\Controllers;

use App\Models\SemestreCursoDocente;
use Illuminate\Http\Request;
use App\Models\Semestre;
use App\Models\User;
use App\Models\Cursos;
use App\Models\Carpeta;

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
    public function crearEstructura($carpetaId, $rutaPadre = '')
    {
        // Obtener la carpeta por su ID
        $carpeta = Carpeta::find($carpetaId);
    
        // Verificar si la carpeta existe
        if ($carpeta) {
            // Crear la carpeta dentro de su carpeta padre
            if( $carpeta->padre != null){
            $rutaCompleta = $rutaPadre . '/' . $carpeta->nombreCarpeta;
            Storage::makeDirectory($rutaCompleta);
        } else{
            $rutaCompleta =$rutaPadre;
        }
            // Obtener todas las subcarpetas de la carpeta actual
            $subcarpetas = $carpeta->hijos;
    
            // Recorrer las subcarpetas y llamar recursivamente a la función para crearlas dentro de su carpeta padre
            foreach ($subcarpetas as $subcarpeta) {
                $this->crearEstructura($subcarpeta->id, $rutaCompleta);
            }
        }
    }
    public function store(Request $request)
    {

        $semestre = Semestre::find($request->semestre_id);
        error_log(print_r($semestre->idCarpeta, true));

        $docente = User::find($request->docente_id);
        $curso = Cursos::find($request->curso_id);

        $carpeta = Carpeta::find($request->formato_id);

        $carpeta = 'Semestre'. '_' . $semestre->año . '_' . $semestre->numero;
        $carpeta = $carpeta . '/'.  $docente->name;

        $carpeta2 ='Semestre'. '_' . $semestre->año . '_' . $semestre->numero . '/' . $docente->name . '/'. 'II Experiencia Curriculares/'. $curso -> NombreCurso;

        $carpeta3 ='Semestre'. '_' . $semestre->año . '_' . $semestre->numero . '/' . $docente->name . '/'. 'I Carga Lectiva y Horario/';

        $idCarpeta = $semestre->idCarpeta;
        $this->crearEstructura($idCarpeta,$carpeta2);

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

        $this->crearEstructura($idCarpeta,$carpeta2);

        try {
            // Verificar si la carpeta no existe
            if (!Storage::exists($carpeta3)) {
                // Intentar crear la carpeta
                Storage::makeDirectory($carpeta3);
               
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
