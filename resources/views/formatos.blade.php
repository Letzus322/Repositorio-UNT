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

    <div class="row">
       

        <div class="col-xxl-4 col-md-6">
            <div id="toggleButton" class="card info-card btn btn-primary revenue-card" data-bs-toggle="collapse" data-bs-target="#contenido">
                <div class="card-body">
                    @if ($padre !== 'null')
                    <h5 class="card-title">Crear nueva carpeta</h5>


                    @else
                    <h5 class="card-title">Crear nuevo formato</h5>

                    @endif
                </div>
            </div>
        </div>
        
        <!--  Solo ocurre para carpetas // CREACION DE ARCHIVOS-->
        @if ($padre !== 'null')
        <div class="col-xxl-4 col-md-6">
            <div id="toggleButton" class="card info-card btn btn-primary revenue-card" data-bs-toggle="collapse" data-bs-target="#archivo">
                <div class="card-body">
                   
                    <h5 class="card-title">Crear formato de archivo a subir</h5>
                 
                </div>
            </div>
        </div>

        <div id="archivo" class="collapse">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                
                <div class="card-header">{{ __('Formato de archivo') }}</div>

               


                
                    <div class="card-body">
                        <form method="POST" action="{{ route('archivos.store') }}" class="row g-3">
                            @csrf

                            <div class="col-md-6">
                                <label for="nombre_curso" class="form-label">Escribe el formato:</label>



                                <input type="text" class="form-control" id="nombreArchivo" name="nombreArchivo" required>
                               
                                <input type="hidden" name="padre" id="padre" value="{{ $padre }}">                             

                            </div>

                           
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary">Guardar Formato</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        </div>


        @endif

    </div>

    <div id="contenido" class="collapse">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                @if ($padre !== 'null')
                    <div class="card-header">{{ __('Nueva Carpeta') }}</div>

                @else
                    <div class="card-header">{{ __('Nuevo Formato') }}</div>

                @endif


                
                    <div class="card-body">
                        <form method="POST" action="{{ route('formatos.store') }}" class="row g-3">
                            @csrf

                            <div class="col-md-6">
                            @if ($padre !== 'null')
                            <label for="nombre_curso" class="form-label">Nombre de la Carpeta:</label>


                            @else
                            <label for="nombre_curso" class="form-label">Nombre del Formato:</label>

                            @endif


                                <input type="text" class="form-control" id="nombreCarpeta" name="nombreCarpeta" required>
                                @if ($padre !== 'null')
                                    <input type="hidden" name="padre" id="padre" value="{{ $padre }}">
                                @endif

                            </div>

                           
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary">Guardar Formato</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
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

    </div> <!-- Cierre del div con clase "row" -->

</div> <!-- Cierre del div con clase "card-body" -->





</main><!-- End #main -->

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const profesoresLink = document.getElementById('formato-link');
        profesoresLink.classList.remove('collapsed');
    });
</script>

