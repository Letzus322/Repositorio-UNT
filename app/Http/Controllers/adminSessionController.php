<?php

namespace App\Http\Controllers;
use App\Models\Cursos;
use App\Models\User;
use App\Models\Semestre;
use App\Models\SemestreCursoDocente;
use Illuminate\Support\Facades\Auth; // Importa la clase Auth
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;

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

    public function download(Request $request)
    {
        // Ruta al archivo en el sistema de almacenamiento
        $rutaArchivo = $request->input('ruta');

        // Verificar si el archivo existe
        if (Storage::exists($rutaArchivo)) {
            // Obtener el contenido del archivo

            $file = Storage::get($rutaArchivo);
                
            // Definir el tipo de respuesta
            $headers = [
                'Content-Type' => Storage::mimeType($rutaArchivo),
                'Content-Disposition' => 'attachment; filename="' . basename($rutaArchivo) . '"',
            ];
    
            // Descargar el archivo
            return response($file, 200, $headers);
        } else {
            // Redirigir a alguna página de error si el archivo no existe
            return redirect()->route('admin');
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
