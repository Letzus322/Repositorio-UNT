<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Formato extends Model
{
    use HasFactory;
    protected $table = 'formatos'; // Reemplaza 'nombre_de_tu_tabla' con el nombre real de tu tabla en la base de datos

    protected $fillable = ['nombreFormato', 'año']; // Especifica las columnas que pueden ser llenadas masivamente

 
}
