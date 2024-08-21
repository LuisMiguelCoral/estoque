<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProdutoBackupController extends Controller
{
    public function index()
    {
        // Recupera os dados da tabela de backup
        $produtosBackup = DB::table('produto_backup')->get();

        // Retorna a visualização com os dados
        return view('produto-backup.index', compact('produtosBackup'));
    }
}

