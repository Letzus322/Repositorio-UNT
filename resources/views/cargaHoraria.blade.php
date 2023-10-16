@extends('menuBaseAdmin')

@section('content')


<main id="main" class="main">

<div class="pagetitle">

  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="index.html">Semestres  </a> </li> 
      
      <li class="breadcrumb-item active"> Año: {{ $semestre->año }} - Período: {{ $semestre->numero }}</li>
    </ol>
  </nav>
</div>

<div class="container mt-5">
    <h1 class="mb-4">Lista de Cursos y Profesores</h1>
    <div class="row">
        <div class="col-md-6 mb-3">
            <!-- Barra desplegable de Profesores -->
            <div class="input-group">
                <label class="input-group-text" for="dropdownProfesores">Profesor</label>
                <select class="form-select" id="dropdownProfesores">
                    <option selected>Selecciona un profesor...</option>
                    @foreach($users as $user)
                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-md-6 mb-3">
            <!-- Barra desplegable de Cursos -->
            <div class="input-group">
                <label class="input-group-text" for="dropdownCursos">Curso</label>
                <select class="form-select" id="dropdownCursos">
                    <option selected>Selecciona un curso...</option>
                    @foreach($cursos as $curso)
                        <option value="{{ $curso->id }}" data-mallacurricular="{{ $curso->MallaCurricular }}">{{ $curso->NombreCurso }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
    <div class="row">      
            <div class="col-md-6 mb-3">
                <div class="form-check me-3">
                    <input class="form-check-input" type="checkbox" id="checkboxAcreditacion">
                    <label class="form-check-label" for="checkboxAcreditacion">Acreditación</label>
                </div>
            </div>
            <div class="col-md-6 mb-3 text-end">             
                <!-- Botón Guardar -->
                <button id="guardarBtn" class="btn btn-primary">Guardar</button>
            </div>
    </div>




    <div id="tabla-container">
    <table class="table table-borderless datatable">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nombre del Curso</th>
                <th scope="col">Malla Curricular</th>
                <th scope="col">Nombre del Docente</th>
                <th scope="col">Acreditacion</th>

            </tr>
        </thead>
        <tbody> 
            <?php $contador = 1; ?>
            @foreach($data as $item)
                <tr>
                    <th scope="row">{{ $contador }}</th>
                    <td>{{ $item->NombreCurso }}</td>
                    <td>{{ $item->MallaCurricular }}</td>
                    <td>{{ $item->NombreDocente }}</td>
                    <td>{{ $item->Acreditacion }}</td>

                </tr>
                <?php $contador++; ?>
            @endforeach
        </tbody>
    </table>
</div>


</div>


    

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const profesoresLink = document.getElementById('carga-link');
        profesoresLink.classList.remove('collapsed');
    });
</script>
       
<script>

document.addEventListener("DOMContentLoaded", function() {
    const guardarBtn = document.getElementById('guardarBtn');
    const dropdownProfesores = document.getElementById('dropdownProfesores');
    const dropdownCursos = document.getElementById('dropdownCursos');
        
    const semestreId = "{{ $semestre->id }}";
    var checkbox = document.getElementById('checkboxAcreditacion');
    var valor = 0;

    // Escuchamos el evento de cambio del checkbox
    checkbox.addEventListener('change', function() {
        // Si el checkbox está marcado, asignamos 1 a la variable; de lo contrario, asignamos 0
        valor = checkbox.checked ? 1 : 0;

        // Puedes usar la variable "valor" en tu lógica posteriormente
        console.log('Valor actual:', valor);
    });
    guardarBtn.addEventListener('click', function() {
        const profesorId = parseInt(dropdownProfesores.value);
        const cursoId = parseInt(dropdownCursos.value);

        fetch(`/cargaHoraria/${semestreId}`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-Token': '{{ csrf_token() }}'
            },
            body: JSON.stringify({
                semestre_id: semestreId,
                curso_id: cursoId,
                docente_id: profesorId,
                Acreditacion:valor
            })
        })

        .then(data => {

                    // Obtener la tabla y su cuerpo
                    const table = document.querySelector('.datatable');
                    const tbody = table.querySelector('tbody');

                    // Crear una nueva fila con los datos seleccionados
                    const row = tbody.insertRow();
                    const rowCount = tbody.rows.length ;
                    const mallaCurricular = dropdownCursos.options[dropdownCursos.selectedIndex].getAttribute('data-mallacurricular');
                    console.log('Nombre del curso seleccionado:', mallaCurricular);

                    const columns = [rowCount, dropdownCursos.selectedOptions[0].text, mallaCurricular, dropdownProfesores.selectedOptions[0].text,valor];
                    columns.forEach((columnText, index) => {
                        const cell = row.insertCell(index);
                        cell.textContent = columnText;
            });
        })

            // Agregar la nueva fila a la tabla

        .catch(error => {
            console.error('Error:', error);
        });
    });
});

    
</script>
</main><!-- End #main -->
