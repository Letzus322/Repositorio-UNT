
@extends('menuBaseAdmin')

@section('content')

<main id="main" class="main">

  <div class="pagetitle">
    <h1>Registrar Profesores</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
        <li class="breadcrumb-item active">Dashboard</li>
      </ol>
    </nav>


  </div><!-- End Page Title -->



      <div class="row">

        
      <div class="col-xxl-4 col-md-6">
    <div class="card info-card revenue-card " >
        <div class="card-body">
            <h5 class="card-title">Numero de profesores</h5>
        </div>
    </div>
</div>

<div class="col-xxl-4 col-md-6">
    <div id="toggleButton" class="card info-card btn btn-primary revenue-card" data-bs-toggle="collapse" data-bs-target="#contenido">
        <div class="card-body">
            <h5 class="card-title">Agregar nuevo profesor</h5>
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








        <!-- list profesores -->
        <div class="col-12">
          <div class="card recent-sales overflow-auto">

            

            
            <div class="card-body">
                  <h5 class="card-title"> Lista de profesores </h5>

          

                <table class="table table-borderless datatable">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nombre</th> <!-- Cambiado de Customer a Name -->
                            <th scope="col">Email</th> <!-- Cambiado de Product a Email -->
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($users as $user)
                  <tr>
                    <th scope="row"><a href="#">{{ $user->id }}</a></th>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                  </tr>
                  @endforeach
                    </tbody>
                </table>
            </div>

          </div>
        </div><!-- End lista profesores -->

        <script>
    document.addEventListener("DOMContentLoaded", function() {
        const profesoresLink = document.getElementById('profesores-link');
        profesoresLink.classList.remove('collapsed');
    });
</script>
</main><!-- End #main -->
