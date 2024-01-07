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
  <section class="panel pg-fw" style="background-color: white; border: 1px solid #ccc; box-shadow: 2px 2px 5px #888888; padding: 20px; border-radius: 8px;">
        <div class="panel-body">

 

            @foreach($cursos as $curso)
                <div class="curso mb-4" style="border-bottom: 1px solid #ccc; padding-bottom: 10px;">
                    <h4 style="font-size: 1.5em; font-weight: bold; font-family: 'Arial', sans-serif;">{{ $curso->curso->NombreCurso }}</h4>
                    <p style="font-size: 1.2em; font-family: 'Arial', sans-serif;"><strong>Docente:</strong> {{ $curso->docente->name }}</p>
                    <p style="font-size: 1.2em; font-family: 'Arial', sans-serif;"><strong>Ciclo:</strong> {{ $curso->curso->ciclo }}</p>

                    <div class="carpetas">
                        @foreach($estructuraJSON['hijos'] as $carpeta)
                            @include('carpetas', ['carpeta' => $carpeta])
                        @endforeach
                    </div>
                </div>


            @endforeach
        </div>

    </section>










</div>



<script>
    document.addEventListener("DOMContentLoaded", function() {
        const profesoresLink = document.getElementById('dashboard-link');
        profesoresLink.classList.remove('collapsed');
    });
</script>
</main><!-- End #main -->
