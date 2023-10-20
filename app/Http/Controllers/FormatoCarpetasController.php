<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cursos;
use App\Models\User;
use App\Models\Semestre;
use App\Models\SemestreCursoDocente;
use App\Models\Formato;

class FormatoCarpetasController extends Controller
{
   
    
    public function store(Request $request)
    {
       
    }

    public function index($formatoId)
    {     $formato = Formato::find($formatoId);
        // Obtén todos los cursos para mostrar en la vista
        $cursos = Cursos::all();
        $users = User::all();
    
   
    
        // Muestra la vista con la lista de cursos
        return view('formatoCarpeta', compact('cursos', 'users', 'formato'));
    }
    

}
