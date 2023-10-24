@extends('menuBaseAdmin')

@section('content')

<main id="main" class="main">

    <div class="pagetitle">
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin') }}">Home</a></li>
                <li class="breadcrumb-item active">Formatos</li>
            </ol>
        </nav>
    </div>  





<div class="card-body">
    @if ($padre !== 'null')
    <h5 class="card-title">Lista de Carpetas</h5>
    @else
    <h5 class="card-title">Lista de formatos</h5>
    @endif

    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-6 g-3">
    @foreach ($carpetas as $carpeta)
    <div class="col-6 mb-3">
        <a href="{{ route('registrarFormatos', ['formatoId' => $carpeta->id]) }}" class="text-decoration-none">
            <div class="card border-0  rounded text-center d-flex align-items-center justify-content-center">
                <i class="bi bi-folder text-primary display-1 mb-2" style="margin-top: 20px;"></i>

                    <h6 class="card-title fw-bold">{{ $carpeta->nombreCarpeta }}</h6>

            </div>
        </a>
    </div>
    @endforeach


       

        @foreach ($archivos as $archivo)
        <div class="col">
            <a href="   " class="text-decoration-none">
                <div class="card border-0  rounded text-center d-flex align-items-center justify-content-center">
                    <i class="bi bi-file-earmark text-primary display-1 mb-2" style="margin-top: 20px;"></i>

                    <h6 class="card-title fw-bold"> {{ $archivo->nombreArchivo }} </h6>
                
                </div>
            </a>
        </div>
        @endforeach



        <div class="col-6 mb-3">
         
                <div  type="button" class="card border-0 rounded text-center d-flex align-items-center justify-content-center"  data-bs-toggle="modal" data-bs-target="#nuevaCarpetaModal">
                    <i class="bi bi-folder-plus text-primary display-1 mb-2" style="margin-top: 20px;"></i>
                        @if ($padre !== 'null')
                            <h6 class="card-title fw-bold">Nueva carpeta</h6>
                        @else
                            <h6 class="card-title fw-bold">Nuevo formato</h6>
                        @endif
                </div>
            </button>
        </div>
        @if ($padre !== 'null')
        <div class="col-6 mb-3">
         
                <div  type="button" class="card border-0 rounded text-center d-flex align-items-center justify-content-center"  data-bs-toggle="modal" data-bs-target="#nuevoArchivoModal">
                    <i class="bi bi-file-earmark-plus text-primary display-1 mb-2" style="margin-top: 20px;"></i>
                        <h6 class="card-title fw-bold">Nuevo archivo</h6>
                </div>
            </button>
        </div>

        <div class="modal fade" id="nuevoArchivoModal" tabindex="-1" aria-labelledby="nuevoArchivoModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="nuevoArchivoModalLabel">Formato de archivo</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="{{ route('archivos.store') }}">
                            @csrf

                            <div class="mb-3">
                                <label for="nombreArchivo" class="form-label">Escribe el formato:</label>
                                <input type="text" class="form-control" id="nombreArchivo" name="nombreArchivo" required>
                                <input type="hidden" name="padre" value="{{ $padre }}">
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                <button type="submit" class="btn btn-primary">Guardar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        @endif



        <!-- Modal -->
    <div class="modal fade" id="nuevaCarpetaModal" tabindex="-1" aria-labelledby="contenidoModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="contenidoModalLabel">
                        @if ($padre !== 'null')
                            Nueva Carpeta
                        @else
                            Nuevo Formato
                        @endif
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('formatos.store') }}">
                        @csrf

                        <div class="mb-3">
                            @if ($padre !== 'null')
                                <label for="nombreCarpeta" class="form-label">Nombre de la Carpeta:</label>
                            @else
                                <label for="nombreCarpeta" class="form-label">Nombre del Formato:</label>
                            @endif
                            <input type="text" class="form-control" id="nombreCarpeta" name="nombreCarpeta" required>
                            @if ($padre !== 'null')
                                <input type="hidden" name="padre" value="{{ $padre }}">
                            @endif
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>

                            @if ($padre !== 'null')
                            <button type="submit" class="btn btn-primary">Guardar Carpeta</button>
                            @else
                            <button type="submit" class="btn btn-primary">Guardar Formato</button>
                            @endif
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    </div> <!-- Cierre del div con clase "row" -->

</div> <!-- Cierre del div con clase "card-body" -->





</main><!-- End #main -->

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const profesoresLink = document.getElementById('formato-link');
        profesoresLink.classList.remove('collapsed');
    });
</script>

