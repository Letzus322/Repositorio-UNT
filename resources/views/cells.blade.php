@if(isset($hijo['hijos']) && count($hijo['hijos']) > 0)
    @foreach($hijo['hijos'] as $subhijo)
        @include('cells', ['hijo' => $subhijo, 'curso' => $curso])
    @endforeach
@else
    <td>
        <!-- Verificar si la carpeta está en la lista de archivos subidos del curso -->
        @if(TRUE)
            <i class="bi bi-check text-success"></i>
        @else
            <i class="bi bi-x text-danger"></i>
        @endif
    </td>
@endif
