<?php

namespace App\Http\Controllers;

use App\Models\Produto;
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
            'quantidade' => 'required|integer',
        ], [
            'nome.unique' => 'Nome selecionado já registrado',
        ]);

        $produto = new Produto;
        $produto->nome = $request->nome;
        $produto->quantidade = $request->quantidade;
        $produto->vendas = 0; // Pode definir um valor padrão para vendas
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

    // Adicionando o método update
    public function update(Request $request, $id)
    {
        $request->validate([
            'vendas' => 'required|integer',
        ]);

        $produto = Produto::findOrFail($id);
        $produto->vendas = $request->input('vendas');
        $produto->save();

        return redirect()->route('produtos.index')
                         ->with('success', 'Vendas atualizadas com sucesso!');
    }
}
