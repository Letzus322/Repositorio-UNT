<?php

namespace App\Http\Controllers;
use App\Models\Cursos;
use App\Models\User;
use App\Models\Semestre;
use App\Models\SemestreCursoDocente;
use Illuminate\Support\Facades\Auth; // Importa la clase Auth
use Illuminate\Support\Facades\Response;

use Illuminate\Http\Request;

class adminSessionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ruta = storage_path('app/'); // Ruta a la carpeta de almacenamiento público

        // Obtener la lista de archivos en la carpeta
        $archivos = scandir($ruta);
    
        // Eliminar los elementos '.' y '..' de la lista
        $archivos = array_diff($archivos, ['.', '..']);
        return view('adminSession', compact('archivos'));

    }


    public function mostrarContenidosCarpeta(Request $request)
    {   
        $datos = $request->input('datos');

        $ruta= 'app/'.$datos;
        // Obtener la lista de archivos y carpetas en la ruta especificada
        $archivos = scandir(storage_path($ruta));
        // Eliminar los elementos '.' y '..' de la lista
        $archivos = array_diff($archivos, ['.', '..']);
 
        // Pasar la lista de archivos y carpetas a la vista
        return view('mostrarContenidos', compact('archivos', 'datos'));
    }

    public function download($filename)
    {
        $rutaArchivo = public_path($filename);

        // Verificar si el archivo existe
        if (file_exists($rutaArchivo)) {
            // Descargar el archivo
            return Response::download($rutaArchivo, $filename);
        } else {
            // Redirigir a alguna página de error si el archivo no existe
            return redirect()->route('error.page');
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
   
    }
    

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
