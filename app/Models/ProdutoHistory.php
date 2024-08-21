<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProdutoHistory extends Model
{
    protected $table = 'produto_histories';
    protected $fillable = ['produto_id', 'quantidade', 'vendas', 'alterado_em'];

    // Relacionamento com o modelo Produto
    public function produto()
    {
        return $this->belongsTo(Produto::class, 'produto_id');
    }
}
