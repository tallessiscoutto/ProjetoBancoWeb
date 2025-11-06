<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Localizacao extends Model
{
    protected $table = 'localizacoes'; // nome da tabela no banco
    protected $fillable = [
        'produto_id', 'prateleira', 'fileira'
    ];

    public function produto()
    {
        return $this->belongsTo(Produto::class, 'produto_id');
    }
}


