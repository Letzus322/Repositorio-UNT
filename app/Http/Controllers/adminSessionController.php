<?php

namespace App\Http\Controllers;
use App\Models\Cursos;
use App\Models\User;
use App\Models\Semestre;
use App\Models\Carpeta;
use App\Models\Archivo;

use App\Models\SemestreCursoDocente;
use Illuminate\Support\Facades\Auth; // Importa la clase Auth
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;

use Illuminate\Http\Request;

class adminSessionController extends Controller
{   
    public function index()
    {
        // Obtener el año actual y el mes actual
        $anoActual = date('Y');
        $mesActual = date('n'); // Obtiene el número del mes sin ceros iniciales
    
        // Determinar el número del semestre actual
        $numeroSemestreActual = ($mesActual >= 1 && $mesActual <= 8) ? 1 : 2;
    
        // Crear el formato del semestre actual (por ejemplo, '2024 - 1' o '2024 - 2')
        $semestreActual = $anoActual . ' - ' . $numeroSemestreActual;
        $semestreId = Semestre::where('año', $anoActual)->where('numero', $numeroSemestreActual)->value('id');

        // Obtener los cursos del semestre actual con sus profesores utilizando un join
        $cursos = SemestreCursoDocente::with(['curso:id,NombreCurso,ciclo', 'docente:id,name'])
        ->where('semestre_id', $semestreId)
        ->select('curso_id', 'docente_id')
        ->get();
        // Obtener los semestres disponibles
        $semestres = Semestre::all();
    
        // Retornar a la vista con los datos


        $estructura = $this->obtenerEstructuraCarpeta(Semestre::where('año', $anoActual)->where('numero', $numeroSemestreActual)->value('idCarpeta'));
        $estructuraJSON = json_encode($estructura);
        $estructuraJSON2 = json_encode($estructura);

        $estructuraJSON = json_decode($estructuraJSON, true);

        $carpetasStorage = $this->obtenerEstructuraCarpetasArchivos("Semestre_2024_1");
        //dd($carpetasStorage);
        return view('adminSession', compact('semestres', 'cursos', 'semestreActual','estructuraJSON','estructuraJSON2','carpetasStorage'));
    }

    public function obtenerEstructuraCarpetasArchivos($ruta)
{
    // Verificar si la ruta existe
    if (Storage::exists($ruta)) {
        // Obtener el contenido de la ruta (archivos y carpetas)
        $contenido = Storage::files($ruta);
        $carpetas = Storage::directories($ruta);

        // Estructura para almacenar la jerarquía de carpetas y archivos
        $estructura = [];

        // Obtener información de carpetas
        foreach ($carpetas as $carpeta) {
            $nombreCarpeta = pathinfo($carpeta, PATHINFO_FILENAME);
            $estructuraCarpeta = $this->obtenerEstructuraCarpetasArchivos($carpeta);
            $estructura[] = [
                'nombre' => $nombreCarpeta,
                'subCarpetas' => $estructuraCarpeta,
            ];
        }

        // Obtener información de archivos
        foreach ($contenido as $item) {
            $nombreArchivo = pathinfo($item, PATHINFO_FILENAME);
            $estructura[] = [
                'nombre' => $nombreArchivo,

            ];
        }

        // Devolvemos la estructura de la carpeta actual
        return $estructura;
    } else {
        // Si la ruta no existe, puedes manejarlo de la manera que desees (lanzar una excepción, devolver un mensaje, etc.)
        return [
            'error' => 'La ruta especificada no existe.',
        ];
    }
}

    public function obtenerEstructuraCarpeta($carpetaId)
    {
        $carpeta = Carpeta::find($carpetaId);
        $gradoDescendencia = $this->contarGeneraciones($carpeta); // Obtener el grado de descendencia
    
        $estructura = [
            'id' => $carpeta->id,
            'nombre' => $carpeta->nombreCarpeta,
            'gradoDescendencia' => $gradoDescendencia,
            'hijos' => [],
            'archivo' => false,

            'existencia' => false
            
        ];
    
        // Obtener todos los archivos de la carpeta actual
        $archivos = Archivo::where('padre', $carpetaId)->get();
    
        // Agregar archivos como hijos directamente sin verificar si tienen subcarpetas
        foreach ($archivos as $archivo) {
            $estructura['hijos'][] = [
                'id' => $archivo->id,
                'nombre' => $archivo->nombreArchivo,
                'gradoDescendencia' => $gradoDescendencia + 1, // Ajustar el grado de descendencia para los archivos
                'hijos' => [] ,// Los archivos no pueden tener hijos, por lo tanto, esta matriz está vacía
                'archivo' => true,

                'existencia' =>  false
            ];
        }
    
        // Obtener todas las subcarpetas de la carpeta actual y llamar recursivamente a la función para obtener su estructura
        $subcarpetas = $carpeta->hijos;
        foreach ($subcarpetas as $subcarpeta) {
            $estructura['hijos'][] = $this->obtenerEstructuraCarpeta($subcarpeta->id);
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
