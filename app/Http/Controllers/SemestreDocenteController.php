<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cursos;
use App\Models\User;
use App\Models\Semestre;
use App\Models\SemestreCursoDocente;
use Illuminate\Support\Facades\Auth; 

class SemestreDocenteController extends Controller
{
   
    
    public function store(Request $request)
    {
        
    }

    public function index($semestreId)
    {
        $id = Auth::user()->id;
        $semestre2 = Semestre::find($semestreId);

         $semestre = Semestre::all();
         $semestrecursodocente = SemestreCursoDocente::all();
 
         $data = SemestreCursoDocente::with(['semestre','curso'])
         ->join('semestres', 'semestre_curso_docente.semestre_id', '=', 'semestres.id')
         ->join('cursos', 'semestre_curso_docente.curso_id', '=', 'cursos.id')
         ->select('semestres.id', 'semestres.año', 'semestres.numero','cursos.NombreCurso')
         ->where('semestre_curso_docente.docente_id', $id)
         ->where('semestre_curso_docente.semestre_id', $semestreId)
         ->get();
        // dd($data);
        // Muestra la vista con la lista de cursos
        return view('semestreDocente',compact('semestre2'))->with('semestres', $data);
    }
    

}
