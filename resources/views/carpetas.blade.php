@if (!function_exists('sustituirVariables'))

@php
    function sustituirVariables($texto, $semestreActual, $docente, $curso)
    {    $anoActual = date('Y');
        $mesActual = date('n'); // Obtiene el número del mes sin ceros iniciales
    
        // Determinar el número del semestre actual
        $numeroSemestreActual = ($mesActual >= 2 && $mesActual <= 8) ? 1 : 2;

        $patron = '/\$(año|semestre|userName|ciclo|curso)\$/';
        $textoSustituido = preg_replace_callback($patron, function($matches) use ($anoActual,$numeroSemestreActual,$semestreActual, $docente, $curso) {
            switch($matches[1]) {
                case 'año':
                    return substr($anoActual, -2);
                case 'semestre':
                    return $numeroSemestreActual;
                case 'userName':
                    return $docente;
                case 'ciclo':
                    return '8';
                case 'curso':
                    return $curso;
                default:
                    return $matches[0];
            }
        }, $texto);
        return $textoSustituido;
    }
@endphp
@endif

@if(isset($carpeta['nombre']))
    <div class="carpeta mb-2">
        <div class="d-flex align-items-center">
            @php
                $nivelAnidamiento = isset($nivelAnidamiento) ? $nivelAnidamiento + 1 : 1;
                $indentacion = str_repeat('&emsp;', $nivelAnidamiento);
            @endphp
            <div class="me-2">{!! $indentacion !!} <i class="bi bi-check text-success"></i></div>
            <div>
                <?php
                    $nombreCarpeta = sustituirVariables($carpeta['nombre'], $semestreActual, Auth::user()->name, $curso->curso->NombreCurso);
                    echo $nombreCarpeta;
                ?>
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

