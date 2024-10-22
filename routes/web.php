<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\ProdutoBackupController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\HistoricoController;

// Rotas de autenticação
Auth::routes();

// Rota para a Home
Route::get('/home', [HomeController::class, 'index'])->name('home');

// Rota resource para o controlador de produtos
Route::resource('produtos', ProdutoController::class);

// Rota para o método updateAll (atualização em massa)
Route::post('/produtos/update-all', [ProdutoController::class, 'updateAll'])->name('produtos.updateAll');

// Rota para o ProdutoBackupController
Route::get('/produto-backup', [ProdutoBackupController::class, 'index'])->name('produto-backup.index');

// Rota para o controlador de histórico
Route::get('/historico', [HistoricoController::class, 'index'])->name('historico.index');

// Rota para o método updateHistoricos no ProdutoController
Route::put('/historico/updateAll', [ProdutoController::class, 'updateHistoricos'])->name('historico.updateAll');

// Rota para média de vendas mensais
Route::get('/media-vendas-mensal', [HistoricoController::class, 'mediaVendasMensal'])->name('media.mensal');

// Rota para relatório de vendas
Route::get('/relatorio-vendas', [HistoricoController::class, 'relatorioVendas'])->name('relatorio.vendas');
