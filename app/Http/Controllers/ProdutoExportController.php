<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use Barryvdh\DomPDF\Facade\Pdf;

class ProdutoExportController extends Controller
{
    public function exportPdf()
    {
        // Obtém todos os produtos para o relatório
        $produtos = Produto::all();

        // Carrega a view 'produtos.export' para gerar o conteúdo do PDF
        $pdf = Pdf::loadView('produtos.export', compact('produtos'))->setOptions(['defaultFont' => 'sans-serif']);

        // Faz o download do PDF com o nome 'produtos_relatorio.pdf'
        return $pdf->download('produtos_relatorio.pdf');
    }
}
