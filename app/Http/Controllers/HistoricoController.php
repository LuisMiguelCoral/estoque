<?php

namespace App\Http\Controllers;

use App\Models\Historico;
use Illuminate\Http\Request;

class HistoricoController extends Controller
{
    public function index(Request $request)
    {
        $query = Historico::query();

        if ($request->has('date') && !empty($request->date)) {
            $date = $request->input('date');
            $query->whereDate('created_at', $date);
        }
        $historicos = $query->orderBy('created_at', 'desc')->get();

        return view('historico.index', compact('historicos'));
    }
}
