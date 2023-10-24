<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Semestre extends Model
{
    use HasFactory;
    protected $table = 'semestres'; // Reemplaza 'nombre_de_tu_tabla' con el nombre real de tu tabla en la base de datos

    protected $fillable = ['año', 'numero','idCarpeta']; // Especifica las columnas que pueden ser llenadas masivamente

    public function semestreCursoDocentes()
    {
        return $this->hasMany(SemestreCursoDocente::class, 'semestre_id');
    }
}
