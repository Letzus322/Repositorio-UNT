@extends('menuBaseAdmin')

@section('content')

<main id="main" class="main">

<div class="pagetitle">
  <h1>Dashboard 2024 - 01</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ route('admin') }}">Home</a></li>
      <li class="breadcrumb-item active">Dashboard</li>
    </ol>
  </nav>
</div><!-- End Page Title -->
<h1>Archivos Disponibles</h1>
    <ul>
    @foreach($archivos as $archivo)
      @if (is_dir(storage_path ('app/'.$archivo)))
         
         
          <form action="{{ route('adminSession.mostrarContenidos') }}" method="GET">
            @csrf
            <input type="hidden" name="datos" value="{{  $archivo }}">
            <button type="submit">{{ $archivo }}</button>
        </form>
      @else
          <a href="{{ route('adminSession.download', ['filename' => $archivo]) }}">{{ $archivo }}</a><br>
      @endif
  @endforeach
    </ul>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const profesoresLink = document.getElementById('dashboard-link');
        profesoresLink.classList.remove('collapsed');
    });
</script>
</main><!-- End #main -->
