<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Carpeta extends Model
{
    use HasFactory;
    protected $table = 'carpetas'; // Reemplaza 'nombre_de_tu_tabla' con el nombre real de tu tabla en la base de datos

    protected $fillable = ['nombreCarpeta', 'padre']; // Especifica las columnas que pueden ser llenadas masivamente

 
}
