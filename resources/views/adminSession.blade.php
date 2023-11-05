@extends('menuBaseAdmin')

@section('content')

<main id="main" class="main">
<div class="pagetitle">

  <div class="pagetitle">
          <h1>Dashboard {{ $semestreActual }} </h1>

          <nav>
              <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="{{ route('admin') }}">Home</a></li>
                  <li class="breadcrumb-item active">Dashboard</li>
              </ol>
          </nav>
  </div>

  @foreach($cursos as $curso)
    <div class="curso mb-4">
        <h4>Curso: {{ $curso->curso->NombreCurso }}</h4>
        <p><strong>Docente:</strong> {{ $curso->docente->name }}</p>
        <div class="carpetas">
            @foreach($estructuraJSON['hijos'] as $carpeta)
                @include('carpetas', ['carpeta' => $carpeta])
            @endforeach
        </div>
    </div>
@endforeach









</div>



<script>
    document.addEventListener("DOMContentLoaded", function() {
        const profesoresLink = document.getElementById('dashboard-link');
        profesoresLink.classList.remove('collapsed');
    });
</script>
</main><!-- End #main -->
