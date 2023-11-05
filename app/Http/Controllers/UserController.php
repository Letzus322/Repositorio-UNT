<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\SemestreCursoDocente;

class UserController extends Controller
{ 
    public function actualizarNombre(Request $request )
    {
        // Validar los datos del formulario si es necesario
       

        // Obtener el usuario actual (asumo que estás utilizando autenticación de Laravel)
        $user = User::first();

        // Actualizar el nombre del usuario con el valor proporcionado en el formulario
        $user->name = $request->input('nuevoNombre');
        $user->save();

        // Redirigir al usuario a una página de éxito o cualquier otra página que desees
        return redirect()->route('home')->with('success', 'Nombre actualizado correctamente');
    }

    public function mostrarDatos()
    {
        $users = User::where('type', 0)->get();
        return view('registrarProfesores')->with('users', $users); // Pasa los datos a la vista
    }


    public function eliminarUsuario(Request $request)
    {
        // Obtén el ID del usuario a eliminar del formulario
        $id = $request->input('id');

        // Busca el usuario por su ID
        $user = User::find($id);
        SemestreCursoDocente::where('docente_id', $user->id)->delete();

        // Verificar si el usuario existe
        if ($user) {
            // Eliminar el usuario de la base de datos
            $user->delete();
    
            // Redirigir al usuario a una página de éxito o cualquier otra página que desees
            return redirect()->route('registrarProfesores')->with('success', 'Usuario eliminado correctamente');
        } else {
            // Si el usuario no existe, redirigir con un mensaje de error
            return redirect()->route('registrarProfesores')->with('error', 'Usuario no encontrado');
        }
    }



}
