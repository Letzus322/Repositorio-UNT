@extends('menuBaseDocente')

@section('content')

<main id="main" class="main">

<div class="pagetitle">
<h2>Contenidos de la Carpeta: {{ $datos }}</h2>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ route('admin') }}">Home</a></li>
      <li class="breadcrumb-item active">Dashboard</li>
    </ol>
  </nav>
</div><!-- End Page Title -->

<div class="row row-cols-1 row-cols-md-2 row-cols-lg-6 g-3">
    @foreach ($archivos as $archivo)
        @if (is_dir(storage_path('app/'.$datos . '/' . $archivo)))
            <div class="col-6 mb-3">
                <a href="{{ route('normalSesion.mostrarContenidos', ['datos' => $datos . '/' . $archivo]) }}" class="text-decoration-none">
                    <div class="card border-0 rounded text-center d-flex align-items-center justify-content-center">
                        <i class="bi bi-folder text-primary display-1 mb-2" style="margin-top: 20px;"></i>
                        <h6 class="card-title fw-bold">{{ $archivo }}</h6>
                    </div>
                </a>
            </div>

        @else

            <div class="col-6 mb-3">
              
              <a href="{{ route('normalSesion.download', ['ruta' =>   $datos . '/' . $archivo]) }}" >

                <div class="card border-0 rounded text-center d-flex align-items-center justify-content-center">
                    <i class="bi bi-file-earmark-text text-primary display-1 mb-2" style="margin-top: 20px;"></i>
                    <h6 class="card-title fw-bold">{{  $archivo }}</h6>
                    
                </div>
              </a>
            </div>
        @endif
    @endforeach


</div>

<form action="{{ route('normalSesion.subirArchivo') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="ruta" value="{{ $datos }}"> <!-- Campo oculto para enviar la ruta -->

    <input type="file" name="archivo" class="form-control mb-3" required>
    <button type="submit" class="btn btn-primary">Subir Archivo</button>
</form>


