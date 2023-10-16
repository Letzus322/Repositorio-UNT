@extends('menuBaseAdmin')

@section('content')

<main id="main" class="main">

    <div class="pagetitle">
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Semestres</a></li>
                <li class="breadcrumb-item active"></li>
                <li class="breadcrumb-item"><a href="index.html">pruebita 2</a></li>

            </ol>
        </nav>
    </div>





</main><!-- End #main -->

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const profesoresLink = document.getElementById('carga-link');
        profesoresLink.classList.remove('collapsed');
    });
</script>

