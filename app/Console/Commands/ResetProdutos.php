<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Produto;
use App\Models\ProdutoBackup;
use Carbon\Carbon;

class ResetProdutos extends Command
{
    protected $signature = 'produtos:reset';
    protected $description = 'Reseta a tabela de produtos e move os dados para a tabela de backup';

    public function handle()
    {
        // Mover dados para o backup
        $produtos = Produto::all();
        foreach ($produtos as $produto) {
            ProdutoBackup::create([
                'nome' => $produto->nome,
                'quantidade' => $produto->quantidade,
                'vendas' => $produto->vendas,
                'backup_date' => Carbon::now(),
            ]);
        }

        // Resetar os produtos
        Produto::query()->update(['quantidade' => 0, 'vendas' => 0]);

        $this->info('Produtos resetados e backup criado com sucesso!');
    }
}

