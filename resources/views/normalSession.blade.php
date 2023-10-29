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
   
         
       

       <div class="col-6 mb-3">
                <a href="{{ route('normalSesion.mostrarContenidos', ['datos' => 'Semestre_'.  $semestre->año .'_' . $semestre->numero . '/' .Auth::user()->name]) }}" class="text-decoration-none">
                    <div class="card border-0 rounded text-center d-flex align-items-center justify-content-center">
                        <i class="bi bi-folder text-primary display-1 mb-2" style="margin-top: 20px;"></i>
                        <h6 class="card-title fw-bold">Año: {{ $semestre->año }} - Período: {{ $semestre->numero }}</h6>
                    </div>
                </a>
        </div>
 


    @endforeach
</div>