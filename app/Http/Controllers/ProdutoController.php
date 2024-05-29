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
            'nome' => 'required|unique:produtos',
            'quantidade' => 'required|integer',
        ]);

        Produto::create($request->all());

        return redirect()->route('produtos.index')
                         ->with('success', 'Produto registrado com sucesso.');
    }
}
