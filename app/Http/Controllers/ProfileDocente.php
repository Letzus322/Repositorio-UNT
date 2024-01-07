<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileDocente extends Controller
{

    /**
     * Show the login form.
     *
     * @return \Illuminate\View\View
     */
    public function editProfile()
    {
       

        $usuario = Auth::user();
        return view('profileDocente', compact('usuario'));
    }

    public function actualizar(Request $request)
    {
        $usuario = Auth::user();
        $usuario->name = $request->input('name');
        $usuario->email = $request->input('email');

        if ($request->hasFile('foto_perfil')) {
            $archivo = $request->file('foto_perfil');
            $nombreArchivo = $request->input('name') . '.' . $archivo->getClientOriginalExtension();
            $rutaGuardada = public_path('images') . '/' . $nombreArchivo;
        
            if (file_exists($rutaGuardada)) {
                // Si el archivo ya existe, eliminarlo antes de mover el nuevo archivo
                unlink($rutaGuardada);
            }
        
            $archivo->move(public_path('images'), $nombreArchivo);
            $rutaImagen = 'images/' . $nombreArchivo;
            $usuario->img = $rutaImagen;
        }
        

        $password = $request->input('password');
        if ($password) {
            $usuario->password = bcrypt($password);
        }
        // Otros campos que quieras actualizar...

        $usuario->save();
        return view('profileDocente', compact('usuario'))->with('success', 'Perfil actualizado exitosamente');

    }
}
