<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SemestreCursoDocente extends Model
{
    protected $table = 'semestre_curso_docente';
    protected $fillable = ['semestre_id', 'curso_id', 'docente_id','Acreditacion'];

    public function semestre()
    {
        return $this->belongsTo(Semestre::class, 'semestre_id');
    }

    public function curso()
    {
        return $this->belongsTo(Cursos::class, 'curso_id');
    }

    public function docente()
    {
        return $this->belongsTo(User::class, 'docente_id');
    }


}

