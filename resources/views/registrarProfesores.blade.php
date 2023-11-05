
@extends('menuBaseAdmin')

@section('content')

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Registrar Profesores</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin') }}">Home</a></li>
                <li class="breadcrumb-item active">Profesores</li>
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
                                <i class="bi bi-person-add"></i>
                            </div>

                            <h5 class="card-title ms-4" > Agregar nuevo profesor</h5>
                    </div>
                </div>
            </div>
        </div>


        <div id="contenido" class="collapse ">
                    
            <div class="row justify-content-center">
                
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">{{ __('Registro') }}</div>

                        <div class="card-body">
                            <form method="POST" action="{{ route('registerPropio') }}">
                                @csrf

                                <div class="row mb-3">
                                    <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Nombre') }}</label>

                                    <div class="col-md-6">
                                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Correo') }}</label>

                                    <div class="col-md-6">
                                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Contraseña') }}</label>

                                    <div class="col-md-6">
                                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirmar Contraseña') }}</label>

                                    <div class="col-md-6">
                                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                    </div>
                                </div>

                                <div class="row mb-0">
                                    <div class="col-md-6 offset-md-4">
                                        <button type="submit" class="btn btn-primary">
                                            {{ __('Registrar') }}
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        </div>

    <div class="col-12">
    
        <div class="card ">

        

        
            <div class="card-body">
                <h5 class="card-title">Lista de profesores</h5>

                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">Número</th>
                                <th scope="col">Nombre</th>
                                <th scope="col">Email</th>
                            </tr>
                        </thead>
                        <tbody>
                        @php
                        $contador = 1;
                        @endphp

                            @foreach ($users as $user)
                            <tr>
                            <th scope="row">{{ $contador }}</th>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    <form action="{{ route('eliminar.usuario') }}" method="POST" class="d-inline">
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $user->id }}">
                                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#confirmarEliminar{{ $user->id }}">
                                            Eliminar
                                        </button>
                                        <!-- Modal de Confirmación -->
                                        <div class="modal fade" id="confirmarEliminar{{ $user->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">

                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Confirmar Eliminación</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        ¿Estás seguro de que deseas eliminar este usuario?
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
                            @php
                            $contador++;    
                            @endphp
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
        const profesoresLink = document.getElementById('profesores-link');
        profesoresLink.classList.remove('collapsed');
    });
</script>
</main><!-- End #main -->
