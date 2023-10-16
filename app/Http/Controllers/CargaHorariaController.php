<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cursos;
use App\Models\User;
use App\Models\Semestre;
use App\Models\SemestreCursoDocente;

class CargaHorariaController extends Controller
{
   
    
    public function store(Request $request)
    {
        $request->validate([
            'nombre_curso' => 'required|string|max:255',
            'malla_curricular' => 'required|string|max:255',
        ]);

        Cursos::create([
            'NombreCurso' => $request->nombre_curso,
            'MallaCurricular' => $request->malla_curricular,
        ]);

        return redirect()->route('cursos')->with('success', 'Curso creado exitosamente.');
    }

    public function index($semestreId)
    {
        // Obtén todos los cursos para mostrar en la vista
        $semestre = Semestre::find($semestreId);
        $cursos = Cursos::all();
        $users = User::all();
    
        $data = SemestreCursoDocente::with(['semestre', 'curso', 'docente'])
            ->join('cursos', 'semestre_curso_docente.curso_id', '=', 'cursos.id')
            ->join('users', 'semestre_curso_docente.docente_id', '=', 'users.id')
            ->select('cursos.id', 'cursos.NombreCurso', 'cursos.MallaCurricular', 'users.name as NombreDocente','Acreditacion')
            ->where('semestre_curso_docente.semestre_id', $semestreId)
            ->get();
    
        // Muestra la vista con la lista de cursos
        return view('cargaHoraria', compact('cursos', 'users', 'semestre', 'data'));
    }
    

}
