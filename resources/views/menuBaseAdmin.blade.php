@extends('layouts.app')

@section('content')

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center">

  <div class="d-flex align-items-center justify-content-between">
  <a href="{{ route('admin') }}" class="logo d-flex align-items-center">
  <img src="{{ asset('universidadlogo.png') }}" alt="Logo de la Empresa" class="img-fluid logo-img" style="max-width: 100px;"> <!-- Agrega esta línea -->

    <span class="d-none d-lg-block">Informática</span>
  </a>
  <i class="bi bi-list toggle-sidebar-btn"></i>
  </div><!-- End Logo -->

    <nav class="header-nav ms-auto">
      <ul class="d-flex align-items-center">

        <li class="nav-item d-block d-lg-none">
          <a class="nav-link nav-icon search-bar-toggle " href="#">
            <i class="bi bi-search"></i>
          </a>
        </li><!-- End Search Icon-->

   
        @if(Auth::user()->img !== '')
        <img src="{{ asset( Auth::user()->img) }}" alt="Foto de perfil" class="rounded-circle" style="width: 50px; height: 50px;">

        @else
            <i class="bi bi-person fs-3 rounded-circle"></i>
        @endif
        <li class="nav-item dropdown pe-3">

          <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
         
            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    <?php echo e(Auth::user()->name); ?>
                              

                                </a>
          </a><!-- End Profile Iamge Icon -->
        
          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
           

            <li>
              <a class="dropdown-item d-flex align-items-center" href="{{ route('profile') }}">
                <i class="bi bi-person"></i>
                <span>My Profile</span>
              </a>
            </li>

            <li>
              <hr class="dropdown-divider">
            </li>

            
            <li>
              
              <a class="dropdown-item d-flex align-items-center" href="<?php echo e(route('logout')); ?>"onclick="event.preventDefault();
                  document.getElementById('logout-form').submit();">
                <i class="bi bi-box-arrow-right"></i>
                <?php echo e(__('Logout')); ?>

              </a>
              <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" class="d-none">
                                        <?php echo csrf_field(); ?>
              </form>
              </li>

           

          </ul><!-- End Profile Dropdown Items -->
        </li><!-- End Profile Nav -->

      </ul>
    </nav><!-- End Icons Navigation -->

  </header><!-- End Header -->

  <!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a id="dashboard-link" class="nav-link collapsed " href="{{ route('admin') }}">
          <i class="bi bi-grid"></i>
          <span>Dashboard</span>
        </a>
      </li><!-- End Dashboard Nav -->

      <li class="nav-item">
        <a  id="profesores-link" class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="" href="{{ route('registrarProfesores') }}">
        <i class="bi bi-person"></i><span>Profesores</span>
        </a>
        
      </li><!-- End Components Nav -->

      <li class="nav-item">
        <a id="cursos-link" class="nav-link collapsed" href="{{ route('registrarCursos') }}">
        <i class="bi bi-book"></i><span>Cursos</span>
        </a>
 
      </li><!-- End Forms Nav -->

    
      <li class="nav-item">
        <a id="formato-link" class="nav-link collapsed" href="{{ route('registrarFormatos', ['formatoId' => 'null']) }}">
          <i class="bi bi-file-earmark"></i>
          <span>Formato de Carpetas</span>
        </a>
      </li><!-- End Blank Page Nav -->


      <li class="nav-item">
        <a  id="carga-link" class="nav-link collapsed" href="{{ route('registrarSemestres') }}">
          <i class="bi bi-calendar2-week"></i><span>Semestres</span>
        </a>
      </li><!-- End Tables Nav -->


    </ul>

  </aside><!-- End Sidebar-->

  <!-- ======= Footer ======= -->
  <footer id="footer" class="footer">
    <div class="copyright">
      &copy; Todos los derechos reservados  <strong><span></span></strong>.
    </div>
    <div class="credits">
      <!-- All the links in the footer should remain intact. -->
      <!-- You can delete the links only if you purchased the pro version. -->
      <!-- Licensing information: https://bootstrapmade.com/license/ -->
      <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/ -->
     Diseñado por alumnos de informática. 
    </div>
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/chart.js/chart.umd.js"></script>
  <script src="assets/vendor/echarts/echarts.min.js"></script>
  <script src="assets/vendor/quill/quill.min.js"></script>
  <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>







@endsection
