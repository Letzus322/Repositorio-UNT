<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

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
        $users = User::all(); // Obtén los datos de la base de datos
        return view('registrarProfesores')->with('users', $users); // Pasa los datos a la vista
    }


}
