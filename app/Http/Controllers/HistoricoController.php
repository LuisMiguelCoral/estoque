<?php

namespace App\Http\Controllers;

use App\Models\Historico;
use App\Models\Produto; // Certifique-se de importar o modelo correto
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class HistoricoController extends Controller
{
    public function index(Request $request)
    {
        $query = Historico::query();
    
        if ($request->has('date') && !empty($request->date)) {
            $date = $request->input('date');
            $query->whereDate('created_at', $date);
        }
    
        if ($request->has('month') && $request->has('year')) {
            $month = $request->input('month');
            $year = $request->input('year');
            $query->whereMonth('created_at', $month)
                  ->whereYear('created_at', $year);
        }
    
        $historicos = $query->orderBy('created_at', 'desc')->get();
    
        return view('historico.index', compact('historicos'));
    }
    
    public function relatorioVendas(Request $request)
    {
        $month = $request->input('month');
        $year = $request->input('year');

        // Verificação de seleção de mês e ano
        if (!$month || !$year) {
            return view('historico.relatorio', [
                'produtosCalculados' => [], 
                'message' => 'Por favor, selecione um mês e um ano.'
            ]);
        }

        // Carrega produtos filtrados por mês e ano
        $produtos = Produto::whereMonth('created_at', $month)
                            ->whereYear('created_at', $year)
                            ->get();

        // Verifica se há produtos no mês selecionado
        if ($produtos->isEmpty()) {
            return view('historico.relatorio', [
                'produtosCalculados' => [], 
                'message' => 'Nenhum produto encontrado para o mês selecionado.'
            ]);
        }

        // Calcular quantidade e vendas acumuladas
        $produtosCalculados = [];

        foreach ($produtos as $produto) {
            if (!isset($produtosCalculados[$produto->nome])) {
                $produtosCalculados[$produto->nome] = [
                    'quantidade' => 0,
                    'vendas' => 0,
                ];
            }

            $produtosCalculados[$produto->nome]['quantidade'] += $produto->quantidade;
            $produtosCalculados[$produto->nome]['vendas'] += $produto->vendas;
        }

        return view('historico.relatorio', [
            'produtosCalculados' => $produtosCalculados,
            'message' => null,
        ]);
    }

    public function mediaVendasMensal(Request $request)
    {
        $month = $request->input('month');
        $year = $request->input('year');
    
        if (!$month || !$year) {
            return view('historico.media', ['produtosCalculados' => [], 'message' => 'Por favor, selecione um mês e um ano.']);
        }
    
        $historicos = Historico::whereMonth('created_at', $month)
                               ->whereYear('created_at', $year)
                               ->get();
    
        $produtosCalculados = []; 
    
        foreach ($historicos as $historico) {
            if (!isset($produtosCalculados[$historico->nome])) {
                $produtosCalculados[$historico->nome] = [
                    'quantidade' => 0,
                    'vendas' => 0,
                    'dias' => [],
                ];
            }
    
            $produtosCalculados[$historico->nome]['quantidade'] += $historico->quantidade;
            $produtosCalculados[$historico->nome]['vendas'] += $historico->vendas;
    
            $createdAt = $historico->created_at->format('Y-m-d');
            $produtosCalculados[$historico->nome]['dias'][$createdAt] = true;
        }
    
        foreach ($produtosCalculados as $nome => $produto) {
            $diasCount = count($produtosCalculados[$nome]['dias']); 
            $produtosCalculados[$nome]['media'] = $produto['vendas'] / ($diasCount > 0 ? $diasCount : 1); 
        }
    
        return view('historico.media', [
            'produtosCalculados' => $produtosCalculados,
            'message' => null,
        ]);
    }
public function downloadMedia(Request $request)
{
    $produtosCalculados = $this->obterDadosCalculados($request); // Função para obter dados filtrados
    $pdf = Pdf::loadView('historico.media', compact('produtosCalculados'))->setOptions(['defaultFont' => 'sans-serif']);
    return $pdf->download('relatorio_media.pdf');
}

}
