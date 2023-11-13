<?php

namespace App\Http\Controllers;
use App\Models\Cursos;
use App\Models\User;
use App\Models\Semestre;
use App\Models\Carpeta;
use App\Models\Archivo;

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
        $semestreActual = $request->input('semestre');
        $archivoActual = $request->input('archivoActual');
        $curso = $request->input('curso');

      

        $docente = User::find($request->input('user'));

        if (Cursos::where('NombreCurso', $request->input('archivoActual'))->exists()) 
            {
        $curso = $request->input('archivoActual');
    }
        $ruta= 'app/'.$datos;
        // Obtener la lista de archivos y carpetas en la ruta especificada
        $archivos = scandir(storage_path($ruta));
        // Eliminar los elementos '.' y '..' de la lista
        $archivos = array_diff($archivos, ['.', '..']);
        $estructura = $this->obtenerEstructuraCarpeta(Semestre::where('id', $semestreActual)->value('idCarpeta'), Semestre::find($request->input('semestre')), $docente, $curso);
        $estructuraJSON = json_encode($estructura);
        $estructuraArray = json_decode($estructuraJSON, true);
        $hijosEncontrados = [];

        $hijosEncontrados = $this->buscarPorNombre($archivoActual, $estructuraArray);
         //dd($hijosEncontrados);

        //$hijosEncontrados = json_encode($hijosEncontrados);

        // Pasar la lista de archivos y carpetas a la vista
        return view('semestreDocente', compact('archivos', 'datos','semestreActual','curso','archivoActual','hijosEncontrados','estructuraJSON'));
    }
    public function buscarPorNombre($nombreBuscado, $estructura) {
        // Itera a través de los hijos de la carpeta actual
        foreach ($estructura['hijos'] as $carpeta) {
            // Verifica si el nombre coincide con la carpeta actual
            if ($carpeta['nombre'] === $nombreBuscado) {
                return $carpeta; // Si encontramos la carpeta, la retornamos
            }
    
            // Si la carpeta actual tiene hijos, realiza la búsqueda recursiva en ellos
            if (!empty($carpeta['hijos'])) {
                $resultadoBusqueda = $this->buscarPorNombre($nombreBuscado, $carpeta);
                if ($resultadoBusqueda) {
                    return $resultadoBusqueda; // Si encontramos la carpeta en los hijos, la retornamos
                }
            }
        }
    
        return null; // Si no encontramos la carpeta, retornamos null
    }
    public function obtenerEstructuraCarpeta($carpetaId, $semestreActual, $docente, $curso )
    {   
        $carpeta = Carpeta::find($carpetaId);
        $gradoDescendencia = $this->contarGeneraciones($carpeta); // Obtener el grado de descendencia
        
        $estructura = [
            'id' => $carpeta->id,
            'nombre' => $carpeta->nombreCarpeta,
            'gradoDescendencia' => $gradoDescendencia,
            'hijos' => []
        ];
    
        // Obtener todos los archivos de la carpeta actual
        $archivos = Archivo::where('padre', $carpetaId)->get();
        // Agregar archivos como hijos directamente sin verificar si tienen subcarpetas
        foreach ($archivos as $archivo) {
            $nombreActual= $this->sustituirVariables($archivo->nombreArchivo , $semestreActual, $docente, $curso) ;

            $estructura['hijos'][] = [
                'id' => $archivo->id,
                'nombre' => $nombreActual,
                'gradoDescendencia' => $gradoDescendencia + 1, // Ajustar el grado de descendencia para los archivos
                'hijos' => [] // Los archivos no pueden tener hijos, por lo tanto, esta matriz está vacía
            ];
        }
    
        // Obtener todas las subcarpetas de la carpeta actual y llamar recursivamente a la función para obtener su estructura
        $subcarpetas = $carpeta->hijos;
        foreach ($subcarpetas as $subcarpeta) {
            $estructura['hijos'][] = $this->obtenerEstructuraCarpeta($subcarpeta->id, $semestreActual, $docente, $curso);
        }
    
        return $estructura;
    }

    public function contarGeneraciones($carpeta)
    {
        $generaciones = 1; // Inicializamos en 1 para contar la generación actual
    
        if ($carpeta->hijos->count() > 0) {
            // Si la carpeta tiene hijos, calculamos las generaciones de los hijos y agregamos 1
            $generaciones += $carpeta->hijos->map(function ($subcarpeta) {
                return $this->contarGeneraciones($subcarpeta);
            })->max();
        }
    
        return $generaciones;
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
    {   $rutaArchivo = $request->input('ruta');
        $semestreActual = Semestre::find($request->input('semestre'));

        $curso = $request->input('curso');
        $docente = User::find($request->input('user'));

        $nombreArchivoSubir = $request->input('nombreArchivo');

        // Validar el formulario
        $request->validate([
        ]);

        // Obtener el archivo del formulario
        $archivo = $request->file('archivo');
        $extensionArchivo = $archivo->getClientOriginalExtension();

       
        $rutaArchivo = $archivo->storeAs($rutaArchivo, $nombreArchivoSubir.'.'.$extensionArchivo);

      
        
        // Puedes guardar información adicional sobre el archivo en la base de datos si es necesario

        // Redirigir de vuelta a la página anterior con un mensaje de éxito
        return back()->with('success', 'El archivo se ha subido correctamente.');
    }
   
    public function sustituirVariables($texto, $semestreActual, $docente, $curso)
    {
        $patron = '/\$(año|semestre|userName|ciclo|curso)\$/';
    
        $textoSustituido = preg_replace_callback($patron, function($matches) use ($semestreActual, $docente,$curso) {
            switch($matches[1]) {
                case 'año':
                    return substr($semestreActual->año, -2); // Aquí deberías tener definida la variable $año
                case 'semestre':
                    return $semestreActual->numero; // Aquí deberías tener definida la variable $Semestre
                case 'userName':
                    return $docente->name; // Aquí deberías tener definida la variable $userName
                case 'ciclo':
                    return '8'; // Aquí deberías tener definida la variable $userName
                case 'curso':
                    return $curso; // Aquí deberías tener definida la variable $userName
                default:
                    return $matches[0]; // Si no coincide con ninguna variable, devolvemos el texto original
            }
        }, $texto);
    
        return $textoSustituido;
    }
    







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
