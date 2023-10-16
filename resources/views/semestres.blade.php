@extends('menuBaseAdmin')

@section('content')

<main id="main" class="main">

    <div class="pagetitle">
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Semestres</a></li>
                <li class="breadcrumb-item active"></li>
            </ol>
        </nav>
    </div>  

    <div class="row">
       

        <div class="col-xxl-4 col-md-6">
            <div id="toggleButton" class="card info-card btn btn-primary revenue-card" data-bs-toggle="collapse" data-bs-target="#contenido">
                <div class="card-body">
                    <h5 class="card-title">Crear nuevo semestre</h5>
                </div>
            </div>
        </div>
    </div>




    <div class="card-body">
    <h5 class="card-title">Lista de semestres</h5>


    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-3">
    @foreach ($semestres as $semestre)
        <div class="col">
        <a href="" class="text-decoration-none">
                <div class="card border-0 shadow rounded">
                    <div class="card-body bg-light">
                        <h5 class="card-title fw-bold mb-2">Año: {{ $semestre->año }} - Período: {{ $semestre->numero }}</h5>
                    </div>
                </div>
            </a>
        </div>
    @endforeach
</div>




</main><!-- End #main -->

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const profesoresLink = document.getElementById('carga-link');
        profesoresLink.classList.remove('collapsed');
    });
</script>

