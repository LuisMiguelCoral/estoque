<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Produto;

class ResetProdutos extends Command
{
    protected $signature = 'produtos:reset';
    protected $description = 'Reseta a quantidade e vendas dos produtos e armazena os dados antigos.';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        // Armazenar dados antigos
        $produtos = Produto::all();
        foreach ($produtos as $produto) {
            \DB::table('produto_backup')->insert([
                'produto_id' => $produto->id,
                'nome' => $produto->nome,
                'quantidade' => $produto->quantidade,
                'vendas' => $produto->vendas,
                'created_at' => now(),
            ]);
        }

        // Resetar valores
        Produto::query()->update([
            'quantidade' => 0,
            'vendas' => 0,
        ]);

        $this->info('Produtos resetados e dados antigos armazenados com sucesso.');
    }
}
