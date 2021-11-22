<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Aluno extends Model
{
    protected $table = 'Aluno';
    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'nome',
        'curso',
        'semestre',
        'ra',
        'cpf',
        'cidade',
        'updated_at',
        'created_at',
    ];
}
