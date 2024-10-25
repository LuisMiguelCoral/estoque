<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use App\Models\Historico;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class ProdutoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $produtos = Produto::all();
        return view('produtos.index', compact('produtos'));
    }

    public function create()
    {
        return view('produtos.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|unique:produtos,nome',
            'quantidade' => 'required|integer|min:0',
        ], [
            'nome.unique' => 'Nome selecionado já registrado',
            'quantidade.min' => 'Quantidade não pode ser negativa',
        ]);

        $produto = new Produto;
        $produto->nome = $request->nome;
        $produto->quantidade = $request->quantidade;
        $produto->vendas = 0; 
        $produto->save();

        Historico::create([
            'produto_id' => $produto->id,
            'nome' => $produto->nome,
            'quantidade' => $produto->quantidade,
            'vendas' => $produto->vendas,
            'created_at' => now(),
        ]);

        return redirect()->route('produtos.index')
                         ->with('success', 'Produto registrado com sucesso.');
    }

    public function destroy($id)
    {
        DB::beginTransaction();
    
        try {
            $produto = Produto::find($id);
            if (!$produto) {
                return redirect()->route('produtos.index')->with('error', 'Produto não encontrado.');
            }

            Historico::where('produto_id', $id)->delete();

            $produto->delete(); 
    
            DB::commit();
            return redirect()->route('produtos.index')->with('success', 'Produto excluído com sucesso.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('produtos.index')->with('error', 'Erro ao excluir o produto: ' . $e->getMessage());
        }
    }

    public function updateAll(Request $request)
    {
        $validatedData = $request->validate([
            'produtos.*.quantidade' => 'required|integer|min:0',
            'produtos.*.vendas' => 'required|integer|min:0',
        ]);
    
        foreach ($validatedData['produtos'] as $produtoId => $data) {
            $produto = Produto::find($produtoId);
            if ($produto) {
                $produto->quantidade = $data['quantidade'];
                $produto->vendas = $data['vendas'];
                $produto->save();

                Historico::create([
                    'produto_id' => $produto->id,
                    'nome' => $produto->nome,
                    'quantidade' => $produto->quantidade,
                    'vendas' => $produto->vendas,
                    'created_at' => now(),
                ]);
            }
        }
    
        return redirect()->route('historico.index')->with('success', 'Produtos atualizados e histórico registrado!');
    }
    
    public function edit($id)
    {
        $produto = Produto::find($id);
        return view('produtos.edit', compact('produto'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'quantidade' => 'required|integer|min:0',
            'vendas' => 'required|integer|min:0',
        ]);
    
        $produto = Produto::findOrFail($id);
        $produto->nome = $request->input('nome');
        $produto->quantidade = $request->input('quantidade');
        $produto->vendas = $request->input('vendas');
        $produto->save();

        $historico = Historico::where('produto_id', $produto->id)
                              ->whereDate('created_at', now()->toDateString())
                              ->first();
        if ($historico) {
            $historico->quantidade = $produto->quantidade;
            $historico->vendas = $produto->vendas;
            $historico->save();
        } else {
            Historico::create([
                'produto_id' => $produto->id,
                'nome' => $produto->nome,
                'quantidade' => $produto->quantidade,
                'vendas' => $produto->vendas,
                'created_at' => now(),
            ]);
        }
    
        return redirect()->route('produtos.index')
            ->with('success', 'Produto atualizado com sucesso!');
    }
    
    
    public function updateHistoricos(Request $request)
    {
        $validatedData = $request->validate([
            'historicos.*.quantidade' => 'required|integer|min:0',
            'historicos.*.vendas' => 'required|integer|min:0',
        ]);

        foreach ($validatedData['historicos'] as $historicoId => $data) {
            $historico = Historico::find($historicoId);
            if ($historico) {
                $historico->quantidade = $data['quantidade'];
                $historico->vendas = $data['vendas'];
                $historico->save();
            }
        }

        return redirect()->route('historico.index')->with('success', 'Histórico atualizado com sucesso!');
    }

    public function reset()
{
    // Reseta a quantidade e vendas de todos os produtos para zero
    Produto::query()->update(['quantidade' => 0, 'vendas' => 0]);

    echo "Valores resetados com sucesso!";
}

    // public function mediaVendasMensal(Request $request)
    // {
    //     $month = $request->input('month');
    //     $year = $request->input('year');

    //     if (!$month || !$year) {
    //         return view('historico.media', ['produtosCalculados' => [], 'message' => 'Por favor, selecione um mês e um ano.']);
    //     }

    //     $produtos = Produto::whereMonth('created_at', $month)
    //                         ->whereYear('created_at', $year)
    //                         ->get();
    
    //     $produtosCalculados = []; 

    //     foreach ($produtos as $produto) {
    //         if (!isset($produtosCalculados[$produto->nome])) {
    //             $produtosCalculados[$produto->nome] = [
    //                 'quantidade' => 0,
    //                 'vendas' => 0,
    //                 'dias' => [], 
    //             ];
    //         }
    
    //         $produtosCalculados[$produto->nome]['quantidade'] += $produto->quantidade;
    //         $produtosCalculados[$produto->nome]['vendas'] += $produto->vendas;
    
    //         $createdAt = $produto->created_at->format('Y-m-d');
    //         if (!isset($produtosCalculados[$produto->nome]['dias'][$createdAt])) {
    //             $produtosCalculados[$produto->nome]['dias'][$createdAt] = true;
    //         }
    //     }

    //     foreach ($produtosCalculados as $nome => $produto) {
    //         $diasCount = count($produtosCalculados[$nome]['dias']); 
    //         $produtosCalculados[$nome]['media'] = $produto['vendas'] / ($diasCount > 0 ? $diasCount : 1); 
    //     }
    
    //     return view('historico.media', [
    //         'produtosCalculados' => $produtosCalculados,
    //         'message' => null,
    //     ]);
    // }
    

}
