<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Semestre;

class NuevoControlador extends Controller
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

    public function index()
{
    // Obtén todos los cursos para mostrar en la vista
    $semestres = Semestre::all();
    
    return view('semestres')->with('semestres', $semestres);
}

}
