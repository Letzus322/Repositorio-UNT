
@extends('menuBaseAdmin')

@section('content')

<main id="main" class="main">
    <!-- ... -->
    <section class="section dashboard">
        <div class="card">
            <div class="card-body">
                    <h5 class="card-title">Editar Perfil</h5>
                    <form action="{{ route('actualizar') }}" method="POST" enctype="multipart/form-data">

                        @csrf
                        <div class="form-group">
                            <label for="name">Nombre</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ $usuario->name }}">
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email" value="{{ $usuario->email }}">
                        </div>

                        <div class="form-group">
                            <label for="email">Contraseña</label>
                            <input type="password" class="form-control" id="password" name="password" value="">
                        </div>

                        <div class="form-group">
                            <label for="foto_perfil">Foto de perfil</label>
                            <br>

                            <input type="file" class="form-control-file" id="foto_perfil" name="foto_perfil">
                        </div>

                        <br>
                        <!-- Otros campos... -->
                        <button type="submit" class="btn btn-primary">Actualizar</button>
                    </form>
            </div>
        </div>  

    </section>
    <!-- ... -->
</main><!-- End #main -->



