<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reserva extends Model
{
    protected $table = 'reservas';
    protected $fillable = ['produto_id', 'cliente_id', 'quantidade', 'data_validade', 'status'];

    public function produto()
    {
        return $this->belongsTo(Produto::class, 'produto_id');
    }

    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'cliente_id');
    }
}


