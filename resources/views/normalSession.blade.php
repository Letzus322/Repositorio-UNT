@extends('menuBaseDocente')

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