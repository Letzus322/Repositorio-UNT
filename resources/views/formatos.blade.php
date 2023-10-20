@extends('menuBaseAdmin')

@section('content')

<main id="main" class="main">

    <div class="pagetitle">
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Formatos</a></li>
                <li class="breadcrumb-item active"></li>
            </ol>
        </nav>
    </div>  

    <div class="row">
       

        <div class="col-xxl-4 col-md-6">
            <div id="toggleButton" class="card info-card btn btn-primary revenue-card" data-bs-toggle="collapse" data-bs-target="#contenido">
                <div class="card-body">
                    <h5 class="card-title">Crear nuevo formato</h5>
                </div>
            </div>
        </div>
    </div>

    <div id="contenido" class="collapse">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Nuevo Formato') }}</div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('formatos.store') }}" class="row g-3">
                            @csrf

                            <div class="col-md-6">
                                <label for="nombre_curso" class="form-label">Nombre del Formato:</label>
                                <input type="text" class="form-control" id="nombreFormato" name="nombreFormato" required>
                            </div>

                            <div class="col-md-6">
                                <label for="malla_curricular" class="form-label">Año del Formato:</label>
                                <input type="text" class="form-control" id="año" name="año" required>
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
    <h5 class="card-title">Lista de semestres</h5>


    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-3">
    @foreach ($formatos as $formato)
        <div class="col">
        <a href="{{ route('formatoCarpeta', ['formatoId' => $formato->id]) }}" class="text-decoration-none">
                <div class="card border-0 shadow rounded">
                    <div class="card-body bg-light">
                        <h5 class="card-title fw-bold mb-2">Año: {{ $formato->nombreFormato }} - Período: {{ $formato->año }}</h5>
                    </div>
                </div>
            </a>
        </div>
    @endforeach
</div>




</main><!-- End #main -->

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const profesoresLink = document.getElementById('formato-link');
        profesoresLink.classList.remove('collapsed');
    });
</script>

