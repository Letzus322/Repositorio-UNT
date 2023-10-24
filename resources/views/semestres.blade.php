@extends('menuBaseAdmin')

@section('content')

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Registrar Semestres</h1>

        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin') }}">Home</a></li>
                <li class="breadcrumb-item active">Semestres</li>
            </ol>
        </nav>
    </div>  

<section class="section dashboard">
    

    <div class="col-lg-8">

        <div class="row">

                    

                    <div class="col-xxl-4 col-md-6">
                        <div id="toggleButton" class="btn btn-primary btn-sm card info-card revenue-card"
                            data-bs-toggle="collapse" data-bs-target="#contenido">

                            <div class="d-flex align-items-center ">
                                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center mr-2">
                                    <i class="bi bi-calendar2-week"></i>
                                </div>

                                <h5 class="card-title mx-2" > Agregar nuevo semestre</h5>
                            </div>
                        </div>
                    </div>

        </div>

        <div id="contenido" class="collapse">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">{{ __('Nuevo Semestre') }}</div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('semestres.store') }}" class="row g-3">
                                @csrf

                                <div class="col-md-6">
                                    <label for="nombre_curso" class="form-label">Año del Semestre:</label>
                                    <input type="text" class="form-control" id="año" name="año" required>
                                </div>

                                <div class="col-md-6">
                                    <label for="malla_curricular" class="form-label">Numero del semestre:</label>
                                    <input type="text" class="form-control" id="numero" name="numero" required>
                                </div>

                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary">Guardar Curso</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <div class="card-body">
        <h5 class="card-title">Lista de semestres</h5>


        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-3">
            @foreach ($semestres as $semestre)
                <div class="col">
                    <a href="{{ route('carga', ['semestreId' => $semestre->id]) }}" class="text-decoration-none">
                        <div class="card border-0 shadow rounded">
                            <div class="card-body bg-light">
                                <h5 class="card-title fw-bold mb-2">Año: {{ $semestre->año }} - Período: {{ $semestre->numero }}</h5>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>  

</section>

</main><!-- End #main -->

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const profesoresLink = document.getElementById('carga-link');
        profesoresLink.classList.remove('collapsed');
    });
</script>

