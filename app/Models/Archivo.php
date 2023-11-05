<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Archivo extends Model
{
    use HasFactory;
    protected $table = 'archivos'; // Reemplaza 'nombre_de_tu_tabla' con el nombre real de tu tabla en la base de datos

    protected $fillable = ['nombreArchivo', 'padre']; // Especifica las columnas que pueden ser llenadas masivamente

    public function hijos()
    {
        return $this->hasMany(Archivo::class, 'padre', 'id');
    }
}
