@extends('menuBaseAdmin')

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

@foreach($archivos as $archivo)
    @if (is_dir(storage_path('app/'.$datos . '/' . $archivo)))
        <form action="{{ route('adminSession.mostrarContenidos') }}" method="GET">
            @csrf
            <input type="hidden" name="datos" value="{{ $datos . '/' . $archivo }}">
            <button type="submit">{{ $archivo }}</button>
        </form>

    @else
       {{ $archivo }}<br>
    @endif
@endforeach