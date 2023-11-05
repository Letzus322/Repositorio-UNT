@if(isset($carpeta['nombre']))
    <div class="carpeta mb-2">
        <div class="d-flex align-items-center">
            @php
                $nivelAnidamiento = isset($nivelAnidamiento) ? $nivelAnidamiento + 1 : 1;
                $indentacion = str_repeat('&emsp;', $nivelAnidamiento);
            @endphp
            <div class="me-2">{!! $indentacion !!} <i class="bi bi-check text-success"></i></div>
            <div>{{ $carpeta['nombre'] }}</div>
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
