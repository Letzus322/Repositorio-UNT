
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
                    <div id="toggleButton" class="btn btn-primary btn-sm card info-card revenue-card"
                        data-bs-toggle="collapse" data-bs-target="#contenido">

                        <div class="d-flex align-items-center ">
                            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center mr-2">
                                <i class="bi bi-journal-plus"></i>
                            </div>

                            <h5 class="card-title ms-4" > Agregar nuevo curso</h5>
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

                                    <div class="col-md-6">
                                        <label for="ciclo" class="form-label">Ciclo:</label>
                                        <input type="int" class="form-control" id="ciclo"
                                            name="ciclo" required>
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
            <div class="card">
                <div class="card-body">
                <h5 class="card-title ">Lista de Cursos</h2> <!-- Utiliza h2 para hacer el texto más grande -->
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">Número</th>
                                    <th scope="col">Nombre</th>
                                    <th scope="col">Malla Curricular</th>
                                    <th scope="col">Ciclo</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($cursos as $curso)
                                <tr>
                                    <th scope="row">{{ $curso->id }}</a></th>
                                    <td>{{ $curso->NombreCurso }}</td>
                                    <td>{{ $curso->MallaCurricular }}</td>
                                    <td>{{ $curso->ciclo }}</td>

                                    <td>
                                        <form action="{{ route('eliminar.curso', ['id' => $curso->id]) }}" method="POST" class="d-inline">
                                            @csrf
                                            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#confirmarEliminar{{ $curso->id }}">
                                                Eliminar
                                            </button>
                                            <!-- Modal de Confirmación -->
                                            <div class="modal fade" id="confirmarEliminar{{ $curso->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Confirmar Eliminación</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            ¿Estás seguro de que deseas eliminar este curso?
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                                            <button type="submit" class="btn btn-danger">Eliminar</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
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


</main><!-- End #main -->
