<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cursos;
use App\Models\SemestreCursoDocente;

class CursosController extends Controller
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
            'ciclo' => $request->ciclo,

        ]);

        return redirect()->route('registrarCursos')->with('success', 'Curso creado exitosamente.');
    }

    public function index()
{
    // Obtén todos los cursos para mostrar en la vista
    $cursos = Cursos::all();

    // Muestra la vista con la lista de cursos
    return view('registrarCursos')->with('cursos', $cursos);
}

public function eliminarCurso(Request $request)
{
    // Obtén el ID del usuario a eliminar del formulario
    $id = $request->input('id');

    // Busca el usuario por su ID
    $curso = Cursos::find($id);
    SemestreCursoDocente::where('curso_id', $curso->id)->delete();

    // Verificar si el usuario existe
    if ($curso) {
        // Eliminar el usuario de la base de datos
        $curso->delete();

        // Redirigir al usuario a una página de éxito o cualquier otra página que desees
        return redirect()->route('registrarCursos')->with('success', 'Usuario eliminado correctamente');
    } else {
        // Si el usuario no existe, redirigir con un mensaje de error
        return redirect()->route('registrarCursos')->with('error', 'Usuario no encontrado');
    }
}

}
