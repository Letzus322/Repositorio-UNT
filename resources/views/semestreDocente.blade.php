@extends('menuBaseDocente')

@section('content')

<main id="main" class="main">

<div class="pagetitle">
<h2>Contenidos de la Carpeta: {{ $datos }} </h2>



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
                <a href="{{ route('normalSesion.mostrarContenidos', ['datos' => $datos . '/' . $archivo  , 'semestre'=> $semestreActual, 'curso'=> $curso , 'archivoActual'=> $archivo , 'user' =>Auth::user()->id  ] ) }}" class="text-decoration-none">
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


@if ($hijosEncontrados !== null)

  @foreach ($hijosEncontrados['hijos'] as $archivo)
  <div class="col-12 mb-3">
    <h4>{{$archivo['nombre']}}</h4>
    <form action="{{ route('normalSesion.subirArchivo') }}" method="POST" enctype="multipart/form-data" class="d-flex">
        @csrf
        <input type="hidden" name="ruta" value="{{ $datos }}"> <!-- Campo oculto para enviar la ruta -->
        <input type="hidden" name="semestre" value="{{ $semestreActual }}"> <!-- Campo oculto para enviar la ruta -->
        <input type="hidden" name="curso" value="{{ $curso }}"> <!-- Campo oculto para enviar la ruta -->
        <input type="hidden" name="user" value="{{ Auth::user()->id }}"> <!-- Campo oculto para enviar la ruta -->
        <input type="hidden" name="nombreArchivo" value="{{$archivo['nombre']}}"> <!-- Campo oculto para enviar la ruta -->

        <div class="flex-grow-1 me-2">
            <input type="file" name="archivo" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Subir Archivo</button>
    </form>
</div>


  @endforeach



@endif
