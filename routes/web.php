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

Route::get('/semestres', [App\Http\Controllers\Semestrecontroller2::class, 'index'])->name('semestres')->middleware('auth');
Route::post('/semestres', [App\Http\Controllers\Semestrecontroller2::class, 'store'])->name('semestres.store')->middleware('auth');

Route::get('/', function () {
    return view('login');
});

Route::get('/login', [App\Http\Controllers\CustomLoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [App\Http\Controllers\CustomLoginController::class, 'login']);
Route::post('/logout', [App\Http\Controllers\CustomLoginController::class, 'logout'])->name('logout');


//USUARIOS RUTAS
Route::get('/adminSession', function () {
    return view('adminSession');
})->middleware('auth')->name('admin');

Route::get('/normalSession', function () {
    return view('normalSession');
})->middleware('auth');

//RUTAS DE LOS ADMINISTRADORES
Route::get('/profesores', [App\Http\Controllers\UserController::class, 'mostrarDatos'])->name('registrarProfesores')->middleware('auth');
Route::post('/registerPropio', [App\Http\Controllers\CustomRegisterController2::class, 'register'])->name('registerPropio');


Route::get('/cursos', [App\Http\Controllers\CursosController::class, 'index'])->name('registrarCursos')->middleware('auth');

Route::post('/cursos', [App\Http\Controllers\CursosController::class, 'store'])->name('cursos.store')->middleware('auth');



