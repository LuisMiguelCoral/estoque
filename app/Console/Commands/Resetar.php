<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Http\Controllers\ProdutoController;

class ResetarQuantidadeEVendas extends Command
{
    protected $signature = 'produtos:resetar';
    protected $description = 'Reseta a quantidade e vendas de todos os produtos diariamente';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $produtoController = new ProdutoController();
        $produtoController->resetarQuantidadeEVendasDiariamente();

        $this->info('Valores de quantidade e vendas resetados com sucesso!');
    }
}
