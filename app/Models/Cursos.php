<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cursos extends Model
{
    use HasFactory;

    protected $table = 'cursos'; // Reemplaza 'nombre_de_tu_tabla' con el nombre real de tu tabla en la base de datos

    protected $fillable = ['NombreCurso', 'MallaCurricular']; // Especifica las columnas que pueden ser llenadas masivamente

    public function semestreCursoDocentes()
    {
        return $this->hasMany(SemestreCursoDocente::class, 'curso_id');
    }
}