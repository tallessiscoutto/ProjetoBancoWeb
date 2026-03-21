<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Funcionario extends Model
{
    use HasFactory;
    
    protected $table = 'funcionarios';

    protected $fillable = [
        'nome',
        'documento',
        'salario',
        'cargo',
        'email'
    ];

    protected $casts = [
        'salario' => 'decimal:2'
    ];
}
