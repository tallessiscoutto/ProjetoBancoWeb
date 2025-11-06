<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Venda extends Model
{
    protected $table = 'vendas';

    protected $fillable = ['produto_id', 'funcionario_id', 'cliente_id', 'quantidade', 'preco_total', 'forma_pagamento', 'data_venda'];

    public function produto()
    {
        return $this->belongsTo(Produto::class, 'produto_id');
    }

    public function funcionario()
    {
        return $this->belongsTo(Funcionario::class, 'funcionario_id');
    }

    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'cliente_id');
    }
}
