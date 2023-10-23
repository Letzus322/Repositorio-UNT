
@extends('menuBaseAdmin')

@section('content')

<main id="main" class="main">

<div class="pagetitle">
  <h1>Registrar Cursos</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ route('admin') }}">Home</a></li>
      <li class="breadcrumb-item active">Cursos</li>
    </ol>
  </nav>
</div><!-- End Page Title -->

<section class="section dashboard">
    

        <div class="col-lg-8">
            <div class="row">

                <div class="col-xxl-4 col-md-6">
                    <div class="card info-card sales-card">
                        <div class="card-body">
                            <h5 class="card-title">Numero de profesores</h5>
                            <div class="d-flex align-items-center">
                                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                    <i class="bi bi-cart"></i>
                                </div>
                                <div class="ps-3">
                                    <h6></h6>
                                    <span class="text-success small pt-1 fw-bold"></span>
                                    <span class="text-muted small pt-2 ps-1"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xxl-4 col-md-6">
                    <div id="toggleButton" class="btn btn-primary btn-sm card info-card revenue-card"
                        data-bs-toggle="collapse" data-bs-target="#contenido">
                        <div class="card-body">
                            <h5 class="card-title">Agregar nuevo curso</h5>
                            <div class="d-flex align-items-center">
                                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                    <i class="bi bi-cart"></i>
                                </div>
                                <div class="ps-3">
                                    <h6></h6>
                                    <span class="text-success small pt-1 fw-bold"></span>
                                    <span class="text-muted small pt-2 ps-1"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div id="contenido" class="collapse">
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-header">{{ __('Nuevo Curso') }}</div>
                            <div class="card-body">
                                <form method="POST" action="{{ route('cursos.store') }}" class="row g-3">
                                    @csrf
                                    <div class="col-md-6">
                                        <label for="nombre_curso" class="form-label">Nombre del Curso:</label>
                                        <input type="text" class="form-control" id="nombre_curso" name="nombre_curso"
                                            required>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="malla_curricular" class="form-label">Malla Curricular:</label>
                                        <input type="text" class="form-control" id="malla_curricular"
                                            name="malla_curricular" required>
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

        <div class="col-12">
            <div class="card recent-sales overflow-auto">
                <div class="card-body">
                    <h5 class="card-title"> Lista de Cursos </h5>
                    <table class="table table-borderless datatable">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nombre</th>
                                <th scope="col">Malla Curricular</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($cursos as $curso)
                            <tr>
                                <th scope="row"><a href="#">{{ $curso->id }}</a></th>
                                <td>{{ $curso->NombreCurso }}</td>
                                <td>{{ $curso->MallaCurricular }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    
</section>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const profesoresLink = document.getElementById('cursos-link');
        profesoresLink.classList.remove('collapsed');
    });
</script>
</body>
</html>

</main><!-- End #main -->
