<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fornecedor extends Model
{
    use HasFactory;

    protected $table = 'fornecedores';

    protected $fillable = [
        'nome',
        'documento',
        'email',
        'telefone',
        'endereco',
        'produtos_disponiveis',
        'formas_pagamento'
    ];

    public function produtos()
    {
        return $this->hasMany(Produto::class);
    }
}
