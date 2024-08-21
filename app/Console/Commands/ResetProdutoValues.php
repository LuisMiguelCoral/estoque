<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Produto;

class ResetProdutoValues extends Command
{
    protected $signature = 'produtos:reset-values';
    protected $description = 'Reset the quantidade and vendas fields of produtos to 0';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        Produto::query()->update(['quantidade' => 0, 'vendas' => 0]);
        $this->info('Valores de quantidade e vendas dos produtos foram resetados para 0.');
    }
}
