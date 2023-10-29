<?php

namespace App\Http\Controllers;
use App\Models\Cursos;
use App\Models\User;
use App\Models\Semestre;
use App\Models\SemestreCursoDocente;
use Illuminate\Support\Facades\Auth; // Importa la clase Auth

use Illuminate\Http\Request;


use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;

class NormalSesionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $id = Auth::user()->id;
       // dd($id);
    

        $data = SemestreCursoDocente::with(['semestre'])
        ->join('semestres', 'semestre_curso_docente.semestre_id', '=', 'semestres.id')
        ->select('semestres.id', 'semestres.año', 'semestres.numero')
        ->where('semestre_curso_docente.docente_id', $id)
        ->distinct('semestres.id')

        ->get();
        //dd($data);
    return view('normalSession')->with('semestres', $data);
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
        return view('semestreDocente', compact('archivos', 'datos'));
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


    public function subirArchivo(Request $request)
    {       $rutaArchivo = $request->input('ruta');
        // Validar el formulario
        $request->validate([
        ]);

        // Obtener el archivo del formulario
        $archivo = $request->file('archivo');

        $nombreArchivoOriginal = $archivo->getClientOriginalName();
        $rutaArchivo = $archivo->storeAs($rutaArchivo, $nombreArchivoOriginal);

      
        
        // Puedes guardar información adicional sobre el archivo en la base de datos si es necesario

        // Redirigir de vuelta a la página anterior con un mensaje de éxito
        return back()->with('success', 'El archivo se ha subido correctamente.');
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
