@extends('menuBaseAdmin')

@section('content')


<main id="main" class="main">

<div class="pagetitle">

  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="index.html">Carpetas  </a> </li> 
      
      <li class="breadcrumb-item active">  {{ $formato->nombreFormato }} </li>
    </ol>
  </nav>
</div>

<div class="container mt-5">
    





</div>


</div>


    


<script>
    document.addEventListener("DOMContentLoaded", function() {
        const profesoresLink = document.getElementById('formato-link');
        profesoresLink.classList.remove('collapsed');
    });
</script>

</main><!-- End #main -->
