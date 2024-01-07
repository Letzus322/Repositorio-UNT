<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('/', function () {

       if (auth()->check()) {
        // Si el usuario está autenticado
        if (auth()->user()->type == 1) {
            return redirect()->route('admin');
        } elseif (auth()->user()->type == 0) {
            return redirect()->route('normalSesion');
        }
    }
    else{
          return view('login');  
    }
});

Route::get('/login', [App\Http\Controllers\CustomLoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [App\Http\Controllers\CustomLoginController::class, 'login']);
Route::post('/logout', [App\Http\Controllers\CustomLoginController::class, 'logout'])->name('logout');


//USUARIOS RUTAS

//

Route::get('/profile', [App\Http\Controllers\Profile::class, 'editProfile'])->name('profile')->middleware(['auth', 'admin']);
Route::post('/profile', [App\Http\Controllers\Profile::class, 'actualizar'])->name('actualizar')->middleware(['auth', 'admin']);


//RUTAS DE LOS ADMINISTRADORES
Route::get('/adminSession', [App\Http\Controllers\adminSessionController::class, 'index'])->name('admin')->middleware(['auth', 'admin']);
Route::get('/adminSession/download',[App\Http\Controllers\adminSessionController::class, 'download'])->name('adminSession.download');
Route::get('/adminSession/mostrarContenidos', [App\Http\Controllers\adminSessionController::class, 'mostrarContenidosCarpeta'] )->name('adminSession.mostrarContenidos');





Route::get('/profesores', [App\Http\Controllers\UserController::class, 'mostrarDatos'])->name('registrarProfesores')->middleware(['auth', 'admin']);
Route::post('/registerPropio', [App\Http\Controllers\CustomRegisterController2::class, 'register'])->name('registerPropio');
Route::post('/eliminarUsuario', [App\Http\Controllers\UserController::class, 'eliminarUsuario'])->name('eliminar.usuario');


Route::get('/cursos', [App\Http\Controllers\CursosController::class, 'index'])->name('registrarCursos')->middleware(['auth', 'admin']);

Route::post('/cursos', [App\Http\Controllers\CursosController::class, 'store'])->name('cursos.store')->middleware('auth');
Route::post('/eliminarCurso', [App\Http\Controllers\CursosController::class, 'eliminarCurso'])->name('eliminar.curso');


Route::get('/semestres', [App\Http\Controllers\SemestreController::class, 'index'])->name('registrarSemestres')->middleware(['auth', 'admin']);

Route::post('/semestres', [App\Http\Controllers\SemestreController::class, 'store'])->name('semestres.store')->middleware('auth');

Route::get('/cargaHoraria/{semestreId}', [App\Http\Controllers\CargaHorariaController::class, 'index'])->name('carga')->middleware(['auth', 'admin']);
Route::post('/cargaHoraria/{semestreId}', [App\Http\Controllers\SemestreCursoDocenteController::class, 'store'])->name('semestres_curso_docente.store')->middleware('auth');


Route::get('/formatos/{formatoId?}', [App\Http\Controllers\FormatoController::class, 'index'])->name('registrarFormatos')->middleware(['auth', 'admin']);

Route::post('/formatos', [App\Http\Controllers\FormatoController::class, 'store'])->name('formatos.store')->middleware('auth');

Route::post('/formatos2', [App\Http\Controllers\ArchivoController::class, 'store'])->name('archivos.store')->middleware('auth');

 




//rutas de docentes
Route::get('/profileDocente', [App\Http\Controllers\ProfileDocente::class, 'editProfile'])->name('profileDocente');
Route::post('/profileDocente', [App\Http\Controllers\ProfileDocente::class, 'actualizar'])->name('actualizarProfileDocente');

Route::get('/normalSesion', [App\Http\Controllers\NormalSesionController::class, 'index'])->name('normalSesion')->middleware('auth');
Route::get('/normalSesion/download',[App\Http\Controllers\NormalSesionController::class, 'download'])->name('normalSesion.download');
Route::get('/normalSesion/mostrarContenidos', [App\Http\Controllers\NormalSesionController::class, 'mostrarContenidosCarpeta'] )->name('normalSesion.mostrarContenidos');

Route::post('/subirarchivo',  [App\Http\Controllers\NormalSesionController::class, 'subirArchivo'] )->name('normalSesion.subirArchivo');


Route::get('/semestreDocente/{semestreId}', [App\Http\Controllers\SemestreDocenteController::class, 'index'])->name('semestreDocente')->middleware('auth');
