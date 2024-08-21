<?php

namespace App\Http\Controllers;

use App\Models\Historico;
use Illuminate\Http\Request;

class HistoricoController extends Controller
{
    public function index()
    {
        $historicos = Historico::all(); // Recupera todos os registros do histórico
        return view('historico.index', compact('historicos')); // Passa os dados para a view
    }
}