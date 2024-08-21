<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use App\Models\Historico;
use Illuminate\Http\Request;

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

        return redirect()->route('produtos.index')
                         ->with('success', 'Produto registrado com sucesso.');
    }

    public function destroy($id)
    {
        $produto = Produto::findOrFail($id);
        $produto->delete();

        return redirect()->route('produtos.index')
                         ->with('success', 'Produto excluído com sucesso!');
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
    
                // Registra a atualização no histórico
                Historico::create([
                    'produto_id' => $produto->id,
                    'nome' => $produto->nome,
                    'quantidade' => $produto->quantidade,
                    'vendas' => $produto->vendas,
                    'created_at' => now(),
                ]);
            }
        }
    
        return redirect()->route('produtos.index')->with('success', 'Produtos atualizados e histórico registrado!');
    }
    
}
