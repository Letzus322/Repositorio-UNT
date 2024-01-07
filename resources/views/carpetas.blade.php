@if (!function_exists('sustituirVariables'))

@php
    function sustituirVariables($texto, $semestreActual, $docente, $curso,$ciclo)
    {    $anoActual = date('Y');
        $mesActual = date('n'); // Obtiene el número del mes sin ceros iniciales
    
        // Determinar el número del semestre actual
        $numeroSemestreActual = ($mesActual >= 1 && $mesActual <= 8) ? 1 : 2;

        $patron = '/\$(año|semestre|userName|ciclo|curso)\$/';
        $textoSustituido = preg_replace_callback($patron, function($matches) use ($anoActual,$numeroSemestreActual,$semestreActual, $docente, $curso,$ciclo) {
            switch($matches[1]) {
                case 'año':
                    return substr($anoActual, -2);
                case 'semestre':
                    return $numeroSemestreActual;
                case 'userName':
                    return $docente;
                case 'ciclo':
                    return $ciclo;
                case 'curso':
                    return $curso;
                default:
                    return $matches[0];
            }
        }, $texto);
        return $textoSustituido;
    }

    function verificarExistenciaCarpetaRecursiva($nombreCarpeta, $estructura)
{
    foreach ($estructura as $carpeta) {
        // Verificar si el nombre de la carpeta coincide
        if ($carpeta['nombre'] === $nombreCarpeta) {
            return true;
        }

        // Verificar en las subcarpetas recursivamente
        if (isset($carpeta['subCarpetas']) && count($carpeta['subCarpetas']) > 0) {
            $existenciaEnSubcarpetas = verificarExistenciaCarpetaRecursiva($nombreCarpeta, $carpeta['subCarpetas']);

            // Si se encuentra en alguna subcarpeta, devolver true
            if ($existenciaEnSubcarpetas) {
                return true;
            }
        }
    }

    // Si no se encuentra en ninguna parte, devolver false
    return false;
}


@endphp
@endif

@if(isset($carpeta['nombre']))
    <div class="carpeta mb-2">
        <div class="d-flex align-items-center">
            @php
                $nivelAnidamiento = isset($nivelAnidamiento) ? $nivelAnidamiento + 1 : 1;
                $indentacion = str_repeat('&emsp;', $nivelAnidamiento);
                $nombreCarpeta = sustituirVariables($carpeta['nombre'], $semestreActual, Auth::user()->name, $curso->curso->NombreCurso,$curso->curso->ciclo);

            @endphp
            <div class="me-2">
                @if ($carpeta['archivo'] == TRUE)
                    @if (verificarExistenciaCarpetaRecursiva($nombreCarpeta, $carpetasStorage))
                    <i class="bi bi-check-circle-fill text-success"></i>
                    @else
                    <i class="bi bi-x-circle-fill text-danger"></i>
                    @endif
                    
                        <?php echo $nombreCarpeta; ?>
                @else
               
                <i class="bi bi-dot"></i>
                
                    <strong><?php echo $nombreCarpeta; ?></strong>

               
                @endif

            </div>
            
        </div>
        @if(isset($carpeta['hijos']) && count($carpeta['hijos']) > 0)
            <div class="ms-4">
                @foreach($carpeta['hijos'] as $subcarpeta)
                    @include('carpetas', ['carpeta' => $subcarpeta, 'nivelAnidamiento' => $nivelAnidamiento])
                @endforeach
            </div>
        @endif
    </div>
@endif

